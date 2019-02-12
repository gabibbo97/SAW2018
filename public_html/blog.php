<!DOCTYPE html>
<html lang="it">

<?php
  require ('lib/head.php');
  drawHead("Blog", "Il nostro blog");
?>

<body>
  <?php require ('lib/header.php'); ?>
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
          <li><a>Papere</a></li>
          <li>
            <a class="is-active">Paperi</a>
          </li>
          <li><a>Test</a></li>
        </ul>
      </aside>
      <div class="column">
        <div class="box">
          <h1 class="title">Top text</h1>
          <h2 class="subtitle">Bottom text - 4/20/1337</h2>
          <a class="button">Leggi di piú</a>
        </div>
        <div class="box">
          <h1 class="title">Top text</h1>
          <h2 class="subtitle">Bottom text - 4/20/1337</h2>
          <a class="button">Leggi di piú</a>
        </div>
        <div class="box">
          <h1 class="title">Top text</h1>
          <h2 class="subtitle">Bottom text - 4/20/1337</h2>
          <a class="button">Leggi di piú</a>
        </div>
        <div class="box">
          <h1 class="title">Top text</h1>
          <h2 class="subtitle">Bottom text - 4/20/1337</h2>
          <a class="button">Leggi di piú</a>
        </div>
        <div class="box">
          <h1 class="title">Top text</h1>
          <h2 class="subtitle">Bottom text - 4/20/1337</h2>
          <a class="button">Leggi di piú</a>
        </div>
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
  <?php require ('lib/footer.php'); ?>
</body>

</html>