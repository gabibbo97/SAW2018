<?php
  function drawHead($title, $descrizione, $extra = NULL) {

    // Crea la sessione se non é giá presente
    if (session_status() === PHP_SESSION_NONE)
      session_start();

    // Leggi il file con il template
    $head = file_get_contents('head.html', TRUE); // Il true indica di cercare 

    // Sostituisci i campi
    $head = str_replace("{{ title }}", $title, $head);
    $head = str_replace("{{ description }}", $descrizione, $head);

    // Aggiungi gli extra
    if (NULL === $extra) {
      $head = str_replace("{{ extra }}", "", $head);
    } else {
      $head = str_replace("{{ extra }}", join("\n", $extra), $head);
    }

    // Inserisci nella pagina
    print($head);

  }
?>