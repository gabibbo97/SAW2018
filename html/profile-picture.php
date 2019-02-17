<?php
  $userPicturesDir = '../images';
  $placeHolderImage = 'assets/images/profile.png';

  function outputImage($fileName) {
    $contentType = mime_content_type($fileName);
    header('Content-Type: '.$contentType);
    readfile($fileName);
    die();
  }

  if (isset($_SESSION['username'])) {
    require ('../lib/db.php');
    $db = dbConnect();
    $userDetailsQuery = $db->prepare('SELECT percorsoImmagine FROM utente WHERE username = :username');
    $userDetailsQuery->bindParam(":username", $_SESSION['username']);
    $userDetailsQuery->execute();
    $userDetails = $userDetailsQuery->fetch(PDO::FETCH_ASSOC);

    if ($userDetails['percorsoImmagine'] == null) {
      outputImage($placeHolderImage);
    } else {

      $userPicture = $userPicturesDir.'/'.$userDetails['percorsoImmagine'];

      if (file_exists($userPicture))
        outputImage($userPicture);
      else
        outputImage($placeHolderImage);
    }
  } else {
    outputImage($placeHolderImage);
  }
?>