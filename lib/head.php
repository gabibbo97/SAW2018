<?php
// Manda alla landing page se non hanno autorizzato il GDPR
if (!isset($_COOKIE['gdprconsent'])) {
    header('Location: landing.html');
    die();
}

function drawHead($title, $descrizione, $extra = null)
{

    // Crea la sessione se
    // - non é giá presente
    // - non abbiamo giá mandato gli header
    if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
        session_start();
    }

    // Leggi il file con il template
    $head = file_get_contents('head.html', true); // Il true indica di cercare

    // Sostituisci i campi
    $head = str_replace("{{ title }}", $title, $head);
    $head = str_replace("{{ description }}", $descrizione, $head);

    // Aggiungi gli extra
    if (null === $extra) {
        $head = str_replace("{{ extra }}", "", $head);
    } else {
        $head = str_replace("{{ extra }}", join("\n", $extra), $head);
    }

    // Inserisci nella pagina
    print($head);

}
