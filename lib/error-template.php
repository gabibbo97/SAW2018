<!DOCTYPE html>
<html lang="it">

<?php
require('../lib/head.php');
drawHead("Homepage", "La nostra homepage");
?>

<body>
  <section class="hero is-light is-fullheight">
    <div class="hero-body">
      <main class="container">
        <div class="message is-danger">
          <div class="message-header">
            <h1 class="title">Errore</h1>
          </div>
          <div class="message-body">
            <?php
              // Stampa il messaggio di errore
              function printErrorDescription($message) {
                print('<h2 class="subtitle">'.htmlspecialchars($message).'</h2>');
              }

              // Se $error é definita, usa il messaggio, altrimenti usa predefinito
              if (isset($error)) {
                printErrorDescription($error);
              } else {
                printErrorDescription("Errore dell'applicazione, riprovare piú tardi, ci scusiamo per il disagio");
              }
            ?>
            <a class="button is-danger is-large is-fullwidth is-outlined" onclick="window.history.back();">Torna indietro</a>
          </div>
        </div>
      </main>
    </div>
    <div class="hero-foot has-text-black">
      <?php require('../lib/footer.php'); ?>
    </div>
  </section>
</body>

</html>
