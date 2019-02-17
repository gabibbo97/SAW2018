<?php
  session_start();

  function outputPlaceholder() {
    $placeHolderImage = 'assets/images/profile.png';

    $contentType = mime_content_type($placeHolderImage);
    header('Content-Type: '.$contentType);
    readfile($placeHolderImage);
    die();
  }

  if (isset($_SESSION['username'])) {
    require ('../lib/db.php');
    $db = dbConnect();
    $userDetailsQuery = $db->prepare('SELECT immagine FROM utente WHERE username = :username');

    $userDetailsQuery->bindParam(":username", $_SESSION['username']);
    $userDetailsQuery->execute();

    // Prendi i dati dell'immagine
    $image = $userDetailsQuery->fetchColumn(0);

    // Se l'utente non ha un'immagine stampa il default
    if ($image == NULL)
      outputPlaceholder();

    // Cerca il mime-type dell'immagine
    $fileInfo = new finfo(FILEINFO_MIME);
    header('Content-Type: '.$fileInfo->buffer($image));

    // Stampa l'immagine
    print($image);
  } else {
    outputPlaceholder();
  }
?>