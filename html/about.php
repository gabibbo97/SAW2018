<!DOCTYPE html>
<html lang="it">

<?php
  require ('../lib/head.php');
  drawHead("Chi siamo", "I nostri punti vendita", array(
    '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="" />',
    '<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>',
    '<script src="assets/js/map.js"></script>'
  ));
?>

<body>
  <?php require ('../lib/header.php'); ?>
  <main>
    <section class="section">
      <div class="container is-fluid">
        <h1 class="title">Le mille più uno paperelle è dal 2018 il leader nel settore della vendita di papere di gomma.</h1>
        <h2 class="subtitle" style="margin-bottom: 0.7em">Trova il punto vendita più vicino a te.</h2>
      </div>
      <map>
        <div class="container is-fluid" id="map" style="height: 40em;">
        </div>
      </map>
      <br>
      <div class="container is-fluid">
        <div class="columns">
          <div class="column message is-info">
            <div class="message-body">
              <a onclick="centerMap(this)">Genova Fiumara</a>
              <p>Via Fiumara 1, Genova</p>
              <p>Tutti i giorni dalle 10 alle 21</p>
            </div>
          </div>
          <div class="column message is-warning">
            <div class="message-body">
              <a onclick="centerMap(this)">Torino Lingotto</a>
              <p>Via Paolo Gaidano 280, Torino</p>
              <p>Lun-Ven: 9:30-12:30 / 15:00-18:00</p>
              <p>Chiuso nei weekend</p>
            </div>
          </div>
          <div class="column message is-danger">
            <div class="message-body">
              <a onclick="centerMap(this)">Milano Fiera</a>
              <p>Foro Buonaparte 77, Milano</p>
              <p>Lun-Ven: 9:30-12:30 / 15:00-18:00</p>
              <p>Sab: 10:00-15:00</p>
              <p>Domenica chiuso</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <?php require ('../lib/footer.php'); ?>
</body>

</html>
