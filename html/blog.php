<?php
  require ('../lib/db.php');
  $db = dbConnect();
  // Se viene fornito un numero di pagina valido usalo
  if (isset($_GET['page'])) {
    if (intval($_GET['page']) > 0) {
      $pageNumber = intval($_GET['page']);
    } else {
      require('../lib/error.php');
      drawError("Numero di pagina richiesto non disponibile");
    }
  } else {
    $pageNumber = 1;
  }
  // Numero di articoli per ogni pagina
  $articlesForEachPage = 5;
  // Controllo se il numero di pagina richiesto é valido
  if (isset($_GET['tag'])) {
    $pageCountQuery = $db->prepare('SELECT CEIL(COUNT(*) / :articlesForEachPage) FROM articolo INNER JOIN caratterizza ON articolo.id = caratterizza.id_articolo WHERE caratterizza.tag = :tag');
    $pageCountQuery->bindParam(":tag", $_GET['tag']);
  } else if (isset($_GET['search'])) {
    $pageCountQuery = $db->prepare('SELECT CEIL(COUNT(*) / :articlesForEachPage) FROM articolo WHERE MATCH(corpo) AGAINST (:searchTerm);');
    $pageCountQuery->bindParam(":searchTerm", $_GET['search']);
  } else {
    $pageCountQuery = $db->prepare('SELECT CEIL(COUNT(*) / :articlesForEachPage) FROM articolo');
  }
  $pageCountQuery->bindParam(":articlesForEachPage", $articlesForEachPage, PDO::PARAM_INT);
  $pageCountQuery->execute();
  $pageCount = $pageCountQuery->fetchColumn(0);
  // Mostra un errore in caso di pagina errata
  if ($pageCount < $pageNumber) {
    require('../lib/error.php');
    if (isset($_GET['search']))
      drawError("Nessun risultato trovato");
    else
      drawError("Numero di pagina richiesto non disponibile");
  }
  require ('../lib/head.php');
  drawHead("Blog", "Il nostro blog");

  // Parametri per gli url
  $params = array(
    'page' => $pageNumber,
  );
  if (isset($_GET['tag']))
    $params['tag'] = $_GET['tag'];
  if (isset($_GET['search']))
    $params['search'] = $_GET['search'];
?>

<body>
  <?php require ('../lib/header.php'); ?>
  <main class="section">
    <div class="columns">
      <aside class="menu column is-one-quarter">
        <p class="menu-label">
          Ricerca
        </p>
        <ul class="menu-list">
          <form>
            <li class="field has-addons">
              <div class="control">
                <input class="input" type="text" placeholder="Ricerca" name="search">
              </div>
              <div class="control">
                <button type="submit" class="button is-info">
                  Cerca
                </button>
              </div>
            </li>
          </form>
        </ul>
        <p class="menu-label">
          Tags
        </p>
        <ul class="menu-list">
          <?php
            // Prendi la lista dei tag dal database
            if (($risQueryTags = $db->query('SELECT nome, descrizione FROM tag ORDER BY LENGTH (nome), nome'))) {

              // Salva e ripristina params['tag']
              $oldTag = $params['tag'];

              // Per ogni riga ritornata
              while (($tag = $risQueryTags->fetch(PDO::FETCH_ASSOC))) {

                $params['tag'] = $tag['nome'];

                // Se in GET viene passato tag e il tag é il corrente
                if (isset($_GET['tag']) && $_GET['tag'] === $tag['nome']) {
                  if (isset($tag['descrizione']))
                    print ('<li><a href="?'.http_build_query($params).'" class="is-active">'.htmlspecialchars($tag['nome'], ENT_HTML5).'<br><small>'.$tag['descrizione'].'</small></a></li>');
                  else
                    print ('<li><a href="?'.http_build_query($params).'" class="is-active">'.htmlspecialchars($tag['nome'], ENT_HTML5).'</a></li>');
                } else {
                  print ('<li><a href="?'.http_build_query($params).'">'.htmlspecialchars($tag['nome'], ENT_HTML5).'</a></li>');
                }
              }

              $params['tag'] = $oldTag;
            }
          ?>
        </ul>
      </aside>
      <div class="column">
        <?php
          // Prepara la query per gli articoli
          if (isset($_GET['tag'])) {
            $articlesQuery = $db->prepare('SELECT id, titolo, sottotitolo, data FROM articolo INNER JOIN caratterizza ON articolo.id = caratterizza.id_articolo WHERE caratterizza.tag = :tag ORDER BY data, id DESC LIMIT :limit OFFSET :offset');
            $articlesQuery->bindParam(":tag", $_GET['tag']);
          } else if ($_GET['search']) {
            $articlesQuery = $db->prepare('SELECT id, titolo, sottotitolo, data FROM articolo WHERE MATCH(corpo) AGAINST (:searchTerm) LIMIT :limit OFFSET :offset');
            $articlesQuery->bindParam(":searchTerm", $_GET['search']);
          } else {
            $articlesQuery = $db->prepare('SELECT id, titolo, sottotitolo, data FROM articolo ORDER BY data, id DESC LIMIT :limit OFFSET :offset');
          }
          $articlesQuery->bindParam(":limit", $articlesForEachPage, PDO::PARAM_INT);
          $articlesQuery->bindParam(":offset", $articlesOffset, PDO::PARAM_INT);

          // Calcola quante righe saltare del risultato
          $articlesOffset = $articlesForEachPage * ($pageNumber - 1);

          // Lancia la query sul database
          $articlesQuery->execute();

          // Prendi e disegna gli articoli
          while (($article = $articlesQuery->fetch(PDO::FETCH_ASSOC))) {

            print('<div class="box">');
            print('<h1 class="title">'.htmlspecialchars($article['titolo'], ENT_HTML5).'</h1>');

            // Il campo sottotitolo é NULL
            if (isset($article['sottotitolo'])) {
              print('<h2 class="subtitle">'.htmlspecialchars($article['sottotitolo'], ENT_HTML5).' - '.$article['data'].'</h2>');
            } else {
              print('<h2 class="subtitle">'.$article['data'].'</h2>');
            }
            print('<a href="blog-article.php?id='.$article['id'].'" class="button">Leggi di piú</a>');
            print('</div>');
          }

          // Stampa delle pagine
          print('<nav class="pagination" aria-label="pagination">');
          if ($pageNumber > 1) {
            $params['page'] = $pageNumber - 1;
            print('<a href="?'.http_build_query($params).'" class="pagination-previous">Pagina precedente</a>');
          }
          if ($pageNumber < $pageCount) {
            $params['page'] = $pageNumber + 1;
            print('<a href="?'.http_build_query($params).'" class="pagination-next">Pagina successiva</a>');
          }
          print('<ul class="pagination-list">');

          // Casi particolari per ultima e penultima pagina
          if ($pageNumber == $pageCount) {
            $currentPage = $pageNumber - 4;
          } else if ($pageNumber == $pageCount - 1) {
            $currentPage = $pageNumber - 3;
          } else {
            $currentPage = $pageNumber - 2;
          }
          $pagesDisplayed = 0;
          $lastPageDisplayed = false;

          while ($pagesDisplayed < 5 && $currentPage <= $pageCount) {
            // Salta le pagine in negativo
            if ($currentPage <= 0) {
              $currentPage++;
              continue;
            }

            // Stampa la pagina
            $params['page'] = $currentPage;
            if ($pageNumber === $currentPage) {
              print('<li><a href=?'.http_build_query($params).' class="pagination-link is-current">'.$currentPage.'</a></li>');
            } else {
              print('<li><a href=?'.http_build_query($params).' class="pagination-link">'.$currentPage.'</a></li>');
            }
            $pagesDisplayed++;

            $currentPage++;
          }

          if ($currentPage <= $pageCount) {
            if ($currentPage < $pageCount)
              print('<span class="pagination-ellipsis">&hellip;</span>');

            $params['page'] = $pageCount;
            print('<li><a href="?'.http_build_query($params).'" class="pagination-link">'.$pageCount.'</a></li>');
          }
          print('</ul>');
          print('</nav>');
        ?>
      </div>
    </div>
  </main>
  <?php require ('../lib/footer.php'); ?>
</body>

</html>