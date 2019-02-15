<!DOCTYPE html>
<html lang="it">

<?php
  if (!isset($_GET['id'])) {
    require('../lib/error.php');
    drawError('Pagina non trovata');
  }

  require ('../lib/db.php');
  $db = dbConnect();
  $query = file_get_contents('../docs/query/blog/articolo_singolo.sql', TRUE);

  $articleQuery = $db->prepare($query);
  $articleQuery->bindParam(":id", $_GET['id']);
  $articleQuery->execute();

  $pageContent = array();

  if ($article = $articleQuery->fetch(PDO::FETCH_ASSOC)) {
    // Titolo
    require ('../lib/head.php');
    drawHead($article['titolo'], $article['titolo']);
    array_push($pageContent, '<h1 class="title">'.htmlspecialchars($article['titolo'], ENT_HTML5).'</h1>');
    // Sottotitolo
    if (isset($article['sottotitolo']))
      array_push($pageContent, '<h2 class="subtitle">'.htmlspecialchars($article['sottotitolo'], ENT_HTML5).'</h2>');
    // Contenuto
    array_push($pageContent, '<div class="content">'.htmlspecialchars($article['corpo'], ENT_HTML5).'</div>');
    // Autore
    array_push($pageContent, '<h3 class="subtitle">Scritto da <i>'.htmlspecialchars($article['autore'], ENT_HTML5).'</i></h3>');
    // Barra precedente / successivo
    if (isset($article['id_prec']) || isset($article['id_succ'])) {
      array_push($pageContent, '<nav class="level is-mobile">');

      if (isset($article['id_prec']))
        array_push($pageContent, '<a href="?id='.$article['id_prec'].'" class="level-item">← '.htmlspecialchars($article['titolo_prec'], ENT_HTML5).'</a>');

      if (isset($article['id_succ']))
        array_push($pageContent, '<a href="?id='.$article['id_succ'].'" class="level-item">'.htmlspecialchars($article['titolo_succ'], ENT_HTML5).' →</a>');

      array_push($pageContent, '</nav>');
    }
  } else {
    require('../lib/error.php');
    drawError('Pagina non trovata');
  }
?>

<body>
  <?php require ('../lib/header.php'); ?>
  <main class="section">
    <div class="box">
      <?php
        foreach ($pageContent as $htmlLine) {
          print($htmlLine);
        }
      ?>
    </div>
  </main>
  <?php require ('../lib/footer.php'); ?>
</body>

</html>
