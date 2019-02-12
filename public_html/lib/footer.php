<?php
  // Leggi il file con il template
  $footer = file_get_contents('footer.html', TRUE); // Il true indica di cercare
  // Inserisci nella pagina
  print($footer);
?>