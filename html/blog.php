<!DOCTYPE html>
<html lang="it">

<?php
  require ('../lib/db.php');
  $db = dbConnect();
  require ('../lib/head.php');
  drawHead("Blog", "Il nostro blog");
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
          <li class="field has-addons">
            <div class="control">
              <input class="input" type="text" placeholder="Ricerca">
            </div>
            <div class="control">
              <a class="button is-info">
                Cerca
              </a>
            </div>
          </li>
        </ul>
        <p class="menu-label">
          Tags
        </p>
        <ul class="menu-list">
          <?php
            if (($risQueryTags = $db->query('SELECT nome FROM tag ORDER BY LENGTH (nome), nome'))) {
              while (($tag = $risQueryTags->fetch(PDO::FETCH_ASSOC))) {
                if (isset($_GET['tag']) && $_GET['tag'] === $tag['nome'])
                  print ('<li><a href="?tag='.$tag['nome'].'" class="is-active">'.$tag['nome'].'</a></li>');
                else
                  print ('<li><a href="?tag='.$tag['nome'].'">'.$tag['nome'].'</a></li>');
              }
            }
          ?>
        </ul>
      </aside>
      <div class="column">
        <?php
          $articlesForEachPage = 5;

          if (isset($_GET['page']) && 0 !== intval($_GET['page']) && intval($_GET['page']) > 0) {
            $pageNumber = intval($_GET['page']);
          } else {
            $pageNumber = 0;
          }

          $articlesQuery = $db->prepare('SELECT id, titolo, sottotitolo, data FROM articolo ORDER BY data, id DESC LIMIT :limit OFFSET :offset');
          $articlesQuery->bindParam(":limit", $articlesForEachPage, PDO::PARAM_INT);
          $articlesQuery->bindParam(":offset", $articlesOffset, PDO::PARAM_INT);
          $articlesOffset = $articlesForEachPage * $pageNumber;

          $articlesQuery->execute();
          while (($article = $articlesQuery->fetch(PDO::FETCH_ASSOC))) {
            print('<div class="box">');
            print('<h1 class="title">'.$article['titolo'].'</h1>');
            if (isset($article['sottotitolo'])) {
              print('<h2 class="subtitle">'.$article['sottotitolo'].' - '.$article['data'].'</h2>');
            } else {
              print('<h2 class="subtitle">'.$article['data'].'</h2>');
            }
            print('<a class="button">Leggi di piú</a>');
            print('</div>');
          }
        ?>
        <nav class="pagination" aria-label="pagination">
          <a class="pagination-previous">Previous</a>
          <a class="pagination-next">Next page</a>
          <ul class="pagination-list">
            <li>
              <a class="pagination-link" aria-label="Goto page 1">1</a>
            </li>
            <li>
              <span class="pagination-ellipsis">&hellip;</span>
            </li>
            <li>
              <a class="pagination-link" aria-label="Goto page 45">45</a>
            </li>
            <li>
              <a class="pagination-link is-current" aria-label="Page 46" aria-current="page">46</a>
            </li>
            <li>
              <a class="pagination-link" aria-label="Goto page 47">47</a>
            </li>
            <li>
              <span class="pagination-ellipsis">&hellip;</span>
            </li>
            <li>
              <a class="pagination-link" aria-label="Goto page 86">86</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </main>
  <?php require ('../lib/footer.php'); ?>
</body>

</html>