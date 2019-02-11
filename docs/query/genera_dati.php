<?php
    // Genera dei dati di prova
    // Fedora: sudo podman run --rm -it --net host -v "$PWD:/app" php /bin/sh -c 'docker-php-ext-install -j $(nproc) pdo_mysql && php -f /app/genera_dati.php || sh'

    $connessione = new PDO("mysql:host=127.0.0.1;dbname=saw", "saw", "saw");
    echo ("Connesso\n");

    $creaTabelle = TRUE;

    $numUtenti = 50;
    $numArticoli = 250;
    $numTag = 250;
    $tagPerArticolo = 5;

    // Cancella tabelle
    if ($creaTabelle) {
        $listaTabelle = array(
            "tag", "utente", "articolo", "caratterizza"
        );
        foreach (array_reverse($listaTabelle) as $tabella) {
            if ($connessione->query("DROP TABLE IF EXISTS ".$tabella)) {
                print("Cancellata tabella\n");
            } else {
                echo ("Cancellazione tabella fallita: ".join(' ', $connessione->errorInfo())."\n");
            }
        }
    }

    // Creazione tabelle
    if ($creaTabelle) {

        $cartellaQuery = opendir("/app/creazione_tabelle");
        $fileConLeQuery = array();
        while (FALSE !== ($file = readdir($cartellaQuery))) {
            if ($file == "." || $file == "..")
                continue;
            array_push($fileConLeQuery, $file);
        }
        sort($fileConLeQuery);
        print_r($fileConLeQuery);

        $listaQuery = array();
        foreach ($fileConLeQuery as $fileName) {
            $testoQuery = file_get_contents("/app/creazione_tabelle/".$fileName);
            array_push($listaQuery, $testoQuery);
        }
        print_r($listaQuery);

        foreach ($listaQuery as $query) {
            if ($connessione->query($query)) {
                print("Creata tabella\n");
            } else {
                echo ("Creazione tabella fallita: ".join(' ', $connessione->errorInfo())."\n");
                echo ("Query: ".$query."\n");
                exit(1);
            }
        }
    }

    // Utenti
    $queryInserisciUtente = $connessione->prepare("INSERT INTO utente(username, nome, cognome, email, password, percorsoImmagine, riceveNewsletter, tipoUtente, regione) VALUES (:username, :nome, :cognome, :email, :password, NULL, :riceveNewsletter, :tipoUtente, :regione)");
    $queryInserisciUtente->bindParam(":username", $username);
    $queryInserisciUtente->bindParam(":nome", $nome);
    $queryInserisciUtente->bindParam(":cognome", $cognome);
    $queryInserisciUtente->bindParam(":email", $email);
    $queryInserisciUtente->bindParam(":password", $password);
    $queryInserisciUtente->bindParam(":riceveNewsletter", $riceveNewsletter);
    $queryInserisciUtente->bindParam(":tipoUtente", $tipoUtente);
    $queryInserisciUtente->bindParam(":regione", $regione);
    for ($i=0; $i < $numUtenti; $i++) { 
        $username = "utente".$i;
        $nome = "Franco";
        $cognome = "Testoni";
        $email = "FrancoTestoni".$i."@email.com";
        $password = password_hash("testPass".$i, PASSWORD_BCRYPT);
        $riceveNewsletter = $i > 10 ? 1 : 0;
        $tipoUtente = $i < 10 ? "ADMIN" : "USER";
        $regione = NULL;
        if($queryInserisciUtente->execute()) {
            echo ("Inserito un utente con successo\n");
        } else {
            echo ("Inserimento fallito: ".join(' ', $queryInserisciUtente->errorInfo())."\n");
            exit(1);
        }
    }
    // Tag
    $queryInserisciTag = $connessione->prepare("INSERT INTO tag (nome, descrizione) VALUES (?, ?)");
    $queryInserisciTag->bindParam(1, $nomeTag);
    $queryInserisciTag->bindParam(2, $descrizioneTag);
    for ($i=0; $i < $numTag; $i++) { 
        $nomeTag = "tag".$i;
        $descrizioneTag = $i < ($numTag * 0.75) ? "Descrizione tag".$i : NULL;
        if($queryInserisciTag->execute()) {
            echo ("Inserito un tag con successo\n");
        } else {
            echo ("Inserimento fallito: ".join(' ', $queryInserisciTag->errorInfo())."\n");
            exit(1);
        }
    }
    // Articoli
    $queryInserisciArticoli = $connessione->prepare("INSERT INTO articolo (titolo, sottotitolo, corpo, autore) VALUES (:titolo, :sottotitolo, :corpo, :autore)");
    $queryInserisciArticoli->bindParam(":titolo", $titolo);
    $queryInserisciArticoli->bindParam(":sottotitolo", $sottotitolo);
    $queryInserisciArticoli->bindParam(":corpo", $corpo);
    $queryInserisciArticoli->bindParam(":autore", $autore);
    for ($i=0; $i < $numArticoli; $i++) {
        $titolo = "Articolo ".$i;
        $sottotitolo = $i < ($numArticoli * 0.75) ? "Sottotitolo articolo ".$i : NULL;

        // Prendi uno username a caso
        if (($risQuery = $connessione->query("SELECT username FROM utente WHERE tipoUtente = 'admin' ORDER BY RAND() LIMIT 1"))) {
            $autore = $risQuery->fetchColumn(0);
        } else {
            echo ("Errore: ".join(' ', $queryInserisciArticoli->errorInfo())."\n");
            exit(1);
        }

        $corpo = "Testo dell'articolo";

        if($queryInserisciArticoli->execute()) {
            echo ("Inserito un articolo con successo\n");
        } else {
            echo ("Inserimento fallito: ".join(' ', $queryInserisciArticoli->errorInfo())."\n");
            exit(1);
        }
    }
    // Caratterizza
    // Itera sugli articoli
    if (($risQuery = $connessione->query("SELECT id FROM articolo"))) {
        $queryCaratterizza = $connessione->prepare("INSERT INTO caratterizza (id_articolo, tag) VALUES (:art, :tag)");
        $queryCaratterizza->bindParam(":art", $idArticolo);
        $queryCaratterizza->bindParam(":tag", $nomeTag);

        $queryPrendiTag = $connessione->prepare("SELECT nome FROM tag ORDER BY RAND() LIMIT :numTags");
        $queryPrendiTag->bindParam(":numTags", $tagPerArticolo, PDO::PARAM_INT);

        while(($idArticolo = $risQuery->fetchColumn(0))) {
            if (!$queryPrendiTag->execute()) {
                echo ("Ricerca tag fallita: ".join(' ', $queryPrendiTag->errorInfo())."\n");
                exit(1);
            }

            while (($nomeTag = $queryPrendiTag->fetchColumn(0))) {
                if($queryCaratterizza->execute()) {
                    echo ("Creata associazione articolo->tag\n");
                } else {
                    echo("Associazione con tag fallita".join(' ', $queryCaratterizza->errorInfo())."\n");
                    exit(1);
                }
            }
        }
    } else {
        echo ("Ricerca articoli fallita: ".join(' ', $queryInserisciArticoli->errorInfo())."\n");
        exit(1);
    }
?>