<?php
  function dbConnect() {
    require('config.php'); // Includi le impostazioni di configurazione
    try {
      $db = new PDO('mysql:'.'dbname='.$databaseName.';host='.$databaseHost, $databaseUser, $databasePassword);
      
      // Inizializza automaticamente il database
      dbInit($db);
      
      return $db;
    } catch (PDOException $exception) {

      // Importa la libreria degli errori
      require('error.php');

      if ($isDevelopment) {
        // Mostra errore completo
        drawError('Errore di connessione al database: '.$exception->getMessage());
      } else {
        // Mostra errore generico
        drawError('Errore di connessione al database');
      }
    }
  }

  function dbInit($connection) {
    /*
      Questa operazione va fatta una sola volta per tutta la "vita" del server
      Se il file 'initialized' esiste, esci subito
      Altrimenti effettua l'inizializzazione
      Non vi sono lock di alcun tipo perché
      - il file viene semplicemente "creato" con dimensione 0 byte
      - l'operazione di inizializzazione é resa idempotente da IF NOT EXISTS
    */
    $initializedFile = dirname($_SERVER['SCRIPT_FILENAME']).'/db-initialized';
    if (file_exists($initializedFile))
      return;
    touch ($initializedFile);

    require('config.php'); // Includi le impostazioni di configurazione

    $cartellaQuery = opendir("../docs/query/creazione_tabelle");
    $fileConLeQuery = array();

    while (FALSE !== ($file = readdir($cartellaQuery))) {
      if ($file == "." || $file == "..")
        continue;
      array_push($fileConLeQuery, $file);
    }
    sort($fileConLeQuery);

    $listaQuery = array();
    foreach ($fileConLeQuery as $fileName) {
      $testoQuery = file_get_contents("../docs/query/creazione_tabelle/".$fileName, TRUE);
      array_push($listaQuery, $testoQuery);
    }

    foreach ($listaQuery as $query) {
      if (!$connection->query($query)) {
        if ($isDevelopment) {
          // Mostra errore completo
          drawError("Creazione tabella fallita: ".join(' ', $connection->errorInfo())."\n");
        } else {
          // Mostra errore generico
          drawError('Errore di connessione al database');
        }
      }
    }
  }
?>