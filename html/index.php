<?php
require '../lib/head.php';
drawHead("Homepage", "La nostra homepage");
?>

<body>
  <?php require '../lib/header.php';?>
  <main class="section">
    <section class="box hero is-warning is-bold">
      <div class="hero-body">
        <div class="container">
          <h1 class="title is-size-1">Le mille piú uno paperelle</h1>
          <h2 class="subtitle is-size-3">Scegli la tua preferita tra una ricca collezione di papere selezionate dai
            migliori esperti del globo in pennuti in vinile.</h2>
        </div>
      </div>
    </section>
    <div class="box">
      <div class="container">
        <figure class="image is-16by9">
          <img style="filter: drop-shadow(0.0em 0.0em 1.0em black);" alt="Tre papere si godono un bagno rilassante" src="assets/images/home.jpg">
        </figure>
      </div>
    </div>
    <section class="box hero is-primary">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">Un prodotto pregiato</h1>
          <div class="content is-size-3">
            <ul>
              <li>Tutte le nostre papere sono certificate CE (Comunitá Europea).</li>
              <li>Nessun materiale tossico o nocivo.</li>
              <li>Severo controllo di qualitá (ciascuna papera viene sottoposta a un bagno di prova da uno dei
                nostri addetti).</li>
              <li>Tutti i nostri impiegati sono contenti di lavorare per noi.</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </main>
  <?php require '../lib/footer.php';?>
</body>

</html>
