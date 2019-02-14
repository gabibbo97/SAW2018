<?php
  // Leggi il file con il template
  $header = file_get_contents('header.html', TRUE); // Il true indica di cercare
  // Inserisci nella pagina
  print($header);
?>