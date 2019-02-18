<?php
require '../lib/head.php';
drawHead("Catalogo", "I nostri prodotti", array(
    '<link rel="stylesheet" href="https://unpkg.com/bulma-slider@2.0.0/dist/css/bulma-slider.min.css" />',
    '<style rel="stylesheet" href="assets/css/catalog.css"></style>',
    '<script src="assets/js/catalog.js"></script>',
));
?>

<body>
  <?php require '../lib/header.php';?>
  <main>
    <div id="imagePreview" class="modal">
      <div class="modal-background"></div>
      <div class="modal-content">
        <p class="image is-1by1">
          <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Nessuna immagine">
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
              <figure class="image is-1by1">
                <img src="assets/images/products/alNaturale/paperellaBlu.png" alt="Paperella blu">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Paperella blu</p>
              <p class="subtitle">Al naturale</p>
              <p>5.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/alNaturale/paperellaGialla.png" alt="Paperella gialla">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Paperella gialla</p>
              <p class="subtitle">Al naturale</p>
              <p>5.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/alNaturale/paperellaRosa.png" alt="Paperella rosa">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Paperella rosa</p>
              <p class="subtitle">Al naturale</p>
              <p>5.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/alNaturale/paperellaVerde.png" alt="Paperella verde">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Paperella verde</p>
              <p class="subtitle">Al naturale</p>
              <p>5.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/celebrita/elvis.png" alt="Elvis">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Elvis</p>
              <p class="subtitle">Celebritá</p>
              <p>51.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/celebrita/statuaLiberta.png" alt="Statua della libertá">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Statua della libertá</p>
              <p class="subtitle">Celebritá</p>
              <p>51.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/celebrita/trump.png" alt="Trump">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Trump</p>
              <p class="subtitle">Celebritá</p>
              <p>51.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/eroi/chewbecca.png" alt="Chewbecca">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Chewbecca</p>
              <p class="subtitle">Eroi</p>
              <p>43.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/eroi/harryPotter.png" alt="Harry Potter">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Harry Potter</p>
              <p class="subtitle">Eroi</p>
              <p>43.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/eroi/hulk.png" alt="Hulk">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Hulk</p>
              <p class="subtitle">Eroi</p>
              <p>43.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/eroi/sherlock.png" alt="Sherlock">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Sherlock</p>
              <p class="subtitle">Eroi</p>
              <p>43.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/eroi/superman.png" alt="Superman">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Superman</p>
              <p class="subtitle">Eroi</p>
              <p>43.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/professioni/dottore.png" alt="Dottore">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Dottore</p>
              <p class="subtitle">Professioni</p>
              <p>17.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/professioni/ingegnere.png" alt="Ingegnere">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Ingegnere</p>
              <p class="subtitle">Professioni</p>
              <p>17.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/professioni/manager.png" alt="Manager">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Manager</p>
              <p class="subtitle">Professioni</p>
              <p>17.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/professioni/panettiere.png" alt="Panettiere">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Panettiere</p>
              <p class="subtitle">Professioni</p>
              <p>17.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/professioni/parrucchiera.png" alt="Parrucchiera">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Parrucchiera</p>
              <p class="subtitle">Professioni</p>
              <p>17.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/professioni/pilota.png" alt="Pilota">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Pilota</p>
              <p class="subtitle">Professioni</p>
              <p>17.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/sport/basketball.png" alt="Basketball">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Basketball</p>
              <p class="subtitle">Sport</p>
              <p>25.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/sport/calciatore.png" alt="Calciatore">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Calciatore</p>
              <p class="subtitle">Sport</p>
              <p>25.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/sport/snowboard.png" alt="Snowboard">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Snowboard</p>
              <p class="subtitle">Sport</p>
              <p>25.90 euro</p>
            </div>
          </div>
          <div class="column is-one-quarter card">
            <div onclick="openImagePreview(this)" class="card-image">
              <figure class="image is-1by1">
                <img src="assets/images/products/sport/tennista.png" alt="Tennista">
              </figure>
            </div>
            <div class="card-content">
              <p class="title">Tennista</p>
              <p class="subtitle">Sport</p>
              <p>25.90 euro</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php require '../lib/footer.php';?>
</body>

</html>