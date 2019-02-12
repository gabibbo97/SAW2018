<!DOCTYPE html>
<html lang="it">

<?php
  require ('lib/head.php');
  drawHead("Catalogo", "I nostri prodotti", array(
    '<link rel="stylesheet" href="https://unpkg.com/bulma-slider@2.0.0/dist/css/bulma-slider.min.css" />',
    '<style rel="stylesheet" href="assets/css/catalog.css"></style>',
    '<script src="assets/js/catalog.js"></script>'
  ));
?>

<body>
  <?php require ('lib/header.php'); ?>
  <main>
    <div id="imagePreview" class="modal">
      <div class="modal-background"></div>
      <div class="modal-content">
        <p class="image is-4by3">
          <img src="https://bulma.io/images/placeholders/1280x960.png" alt="">
        </p>
      </div>
      <button class="modal-close is-large" aria-label="close" onclick="closeImagePreview()"></button>
    </div>
    <div class="tile is-ancestor">
      <div class="tile is-child is-3 section">
        <form>
          <p class="title is-size-4">Ricerca per nome:</p>
          <div class="field has-addons">
            <div class="control is-expanded">
              <input id="searchBar" class="input is-info" type="text" placeholder="Cerca una paperella">
            </div>
            <div class="control">
              <a id="searchButton" class="button is-info" onclick="searchByName(this)">
                Cerca
              </a>
            </div>
          </div>
          <br>
          <p class="title is-size-4">Ricerca per prezzo:</p>
          <p>Prezzo massimo: <output for="priceSelector">50.00 euro</output></p>
          <input id="priceSelector" class="slider is-fullwidth is-large is-warning" step="5" min="5" max="50" value="50"
            type="range" oninput="updatePrice(this.value)" onchange="updatePrice(this.value)">
          <br>
          <p class="title is-size-4">Ricerca per categorie:</p>
          <div class="field">
            <a class="button is-outlined is-fullwidth" onclick="updateCategories(this)">Al naturale</a>
          </div>
          <div class="field">
            <a class="button is-outlined is-fullwidth" onclick="updateCategories(this)">Celebritá</a>
          </div>
          <div class="field">
            <a class="button is-outlined is-fullwidth" onclick="updateCategories(this)">Eroi</a>
          </div>
          <div class="field">
            <a class="button is-outlined is-fullwidth" onclick="updateCategories(this)">Professioni</a>
          </div>
          <div class="field">
            <a class="button is-outlined is-fullwidth" onclick="updateCategories(this)">Sport</a>
          </div>
        </form>
      </div>
      <div class="tile is-child is-9 section">
        <div class="columns is-multiline">
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-4by3">
                <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Prodotto</p>
              <p class="subtitle">Categoria</p>
              <p>43.20 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-4by3">
                <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Prodotto</p>
              <p class="subtitle">Categoria</p>
              <p>43.20 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-4by3">
                <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Prodotto</p>
              <p class="subtitle">Eroi</p>
              <p>43.20 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-4by3">
                <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Prodotto</p>
              <p class="subtitle">Eroi</p>
              <p>43.20 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-4by3">
                <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Prodotto</p>
              <p class="subtitle">Categoria</p>
              <p>43.20 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-4by3">
                <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Prodotto</p>
              <p class="subtitle">Sport</p>
              <p>43.20 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-4by3">
                <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Prodotto</p>
              <p class="subtitle">Categoria</p>
              <p>43.20 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-4by3">
                <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Prodotto</p>
              <p class="subtitle">Categoria</p>
              <p>43.20 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-4by3">
                <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Prodotto</p>
              <p class="subtitle">Categoria</p>
              <p>22.20 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-4by3">
                <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Prodotto</p>
              <p class="subtitle">Categoria</p>
              <p>37.20 euro</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php require ('lib/footer.php'); ?>
</body>

</html>