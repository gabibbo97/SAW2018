<?php
require '../lib/db.php';
$db = dbConnect();

// Controllo email
if (isset($_GET['checkEmail'])) {
    $checkEmailQuery = $db->prepare('SELECT COUNT(*) AS "count" FROM utente WHERE email = :email');
    $checkEmailQuery->bindParam(":email", $_GET['checkEmail']);
    $checkEmailQuery->execute();
    $emailCount = $checkEmailQuery->fetchColumn(0);
    if ($emailCount == 0) {
        print(json_encode(array('exists' => false)));
    } else {
        print(json_encode(array('exists' => true)));
    }

    die();
}

// Controllo username
if (isset($_GET['checkUsername'])) {
    $checkUsernameQuery = $db->prepare('SELECT COUNT(*) AS "count" FROM utente WHERE username = :user');
    $checkUsernameQuery->bindParam(":user", $_GET['checkUsername']);
    $checkUsernameQuery->execute();
    $userCount = $checkUsernameQuery->fetchColumn(0);
    if ($userCount == 0) {
        print(json_encode(array('exists' => false)));
    } else {
        print(json_encode(array('exists' => true)));
    }

    die();
}

// Controllo registrazione
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../lib/error.php';

    // Nome
    if (!isset($_POST['nome'])) {
        drawError("Nome assente");
    }

    if (strlen($_POST['nome']) < 2) {
        drawError("Nome troppo corto");
    }

    if (strlen($_POST['nome']) > 20) {
        drawError("Nome troppo lungo");
    }

    if (!preg_match("/[A-Za-zèùàòé][a-zA-Z'èùàòé ]*/", $_POST['nome'])) {
        drawError("Nome con caratteri non ammessi");
    }

    // Cognome
    if (!isset($_POST['cognome'])) {
        drawError("Cognome assente");
    }

    if (strlen($_POST['cognome']) < 2) {
        drawError("Cognome troppo corto");
    }

    if (strlen($_POST['cognome']) > 20) {
        drawError("Cognome troppo lungo");
    }

    if (!preg_match("/[A-Za-zèùàòé][a-zA-Z'èùàòé ]*/", $_POST['cognome'])) {
        drawError("Cognome con caratteri non ammessi");
    }

    // Username
    if (!isset($_POST['username'])) {
        drawError("Username assente");
    }

    if (strlen($_POST['username']) < 3) {
        drawError("Username troppo corto");
    }

    if (strlen($_POST['username']) > 20) {
        drawError("Username troppo lungo");
    }

    if (!preg_match("/[a-zA-Z0-9_-]+/", $_POST['username'])) {
        drawError("Username con caratteri non ammessi");
    }

    // Password
    if (!isset($_POST['password1'])) {
        drawError("Password assente");
    }

    if (strlen($_POST['password1']) < 6) {
        drawError("Password troppo corta");
    }

    if (strlen($_POST['password1']) > 255) {
        drawError("Password troppo lunga");
    }

    if ($_POST['password1'] != $_POST['password2']) {
        drawError("Le password non corrispondono");
    }

    // Email
    if (!isset($_POST['email'])) {
        drawError("Email assente");
    }

    if (strlen($_POST['email']) < 6) {
        drawError("Email troppo corta");
    }

    if (strlen($_POST['email']) > 255) {
        drawError("Email troppo lunga");
    }

    if (!preg_match("/.+@.+\..+/", $_POST['email'])) {
        drawError("Email con caratteri non ammessi");
    }

    // Termini e condizioni
    if (!isset($_POST['terminiCondizioni'])) {
        drawError("Devi accettare termini e condizioni");
    }

    // Query inserimento
    $insertUserQuery = $db->prepare('INSERT INTO utente (username, nome, cognome, email, password, riceveNewsletter, regione) VALUES (:username, :nome, :cognome, :email, :password, :riceveNewsletter, :regione)');
    $insertUserQuery->bindParam(":username", strtolower($_POST['username']));
    $insertUserQuery->bindParam(":nome", $_POST['nome']);
    $insertUserQuery->bindParam(":cognome", $_POST['cognome']);
    $insertUserQuery->bindParam(":email", strtolower($_POST['email']));
    $insertUserQuery->bindParam(":password", $password);
    $insertUserQuery->bindParam(":riceveNewsletter", $riceveNewsletter, PDO::PARAM_BOOL);
    $insertUserQuery->bindParam(":regione", $regione);

    $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
    if ($_POST['newsletter'] == 'on') {
        $riceveNewsletter = true;
    } else {
        $riceveNewsletter = false;
    }

    switch ($_POST['regione']) {
        case "Abruzzo":
            $regione = "Abruzzo";
            break;
        case "Basilicata":
            $regione = "Basilicata";
            break;
        case "Calabria":
            $regione = "Calabria";
            break;
        case "Campania":
            $regione = "Campania";
            break;
        case "Emilia-Romagna":
            $regione = "EmiliaRomagna";
            break;
        case "Friuli-Venezia Giulia":
            $regione = "FriuliVeneziaGiulia";
            break;
        case "Lazio":
            $regione = "Lazio";
            break;
        case "Liguria":
            $regione = "Liguria";
            break;
        case "Lombardia":
            $regione = "Lombardia";
            break;
        case "Marche":
            $regione = "Marche";
            break;
        case "Molise":
            $regione = "Molise";
            break;
        case "Piemonte":
            $regione = "Piemonte";
            break;
        case "Puglia":
            $regione = "Puglia";
            break;
        case "Sardegna":
            $regione = "Sardegna";
            break;
        case "Sicilia":
            $regione = "Sicilia";
            break;
        case "Toscana":
            $regione = "Toscana";
            break;
        case "Trentino-Alto Adige":
            $regione = "TrentinoAltoAdige";
            break;
        case "Umbria":
            $regione = "Umbria";
            break;
        case "Valle d'Aosta":
            $regione = "ValleDAosta";
            break;
        case "Veneto":
            $regione = "Veneto";
            break;
        default:
            $regione = null;
            break;
    }

    if ($insertUserQuery->execute()) {
        session_start();

        $_SESSION['username'] = strtolower($_POST['username']);
        $_SESSION['role'] = 'USER';

        header('Location: profile.php');
    } else {
        require '../config.php';
        if ($isDevelopment) {
            drawError("Creazione utente fallita: " . join(' ', $insertUserQuery->errorInfo()));
        } else {
            drawError("Creazione utente fallita");
        }
    }
}
?>
<?php
require '../lib/head.php';
drawHead("Profilo", "Gestione attivitá", array(
    '<link rel="stylesheet" href="assets/css/registration.css">',
    '<script src="assets/js/registration.js"></script>',
));
?>

<body>
  <section class="section">
    <div class="container">
      <div class="level">
        <div class="level-item">
          <div class="box">
            <div class="level">
              <div class="level-item">
                <h1 class="title">Registrazione</h1>
              </div>
            </div>
            <form id="Registrazione" method="POST" action="registration.php">
              <div class="field">
                <label class="label">Name</label>
                <div class="control">
                  <input required class="input" maxlength="20" type="text" placeholder="Nome" name="nome" <?php if (isset($_POST['nome'])) {print('value="' . $_POST['nome'] . '"');}?>>
                </div>
              </div>
              <div class="field">
                <label class="label">Cognome</label>
                <div class="control">
                  <input required class="input" maxlength="20" type="text" placeholder="Cognome" name="cognome" <?php if (isset($_POST['cognome'])) {print('value="' . $_POST['cognome'] . '"');}?>>
                </div>
              </div>
              <div class="field">
                <label class="label">Username</label>
                <div class="control has-icons-left has-icons-right">
                  <!--input is-correct quando è disponibile il bordo diventa verde
                  input is-warning giallo
                  input is-danger rosso
                  input is-info blu-->
                  <input required class="input" onchange="checkUsername(this);" minlength="3" maxlength="20" type="text" placeholder="Username" name="username" <?php if (isset($_POST['username'])) {print('value="' . $_POST['username'] . '"');}?>>
                  <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                  </span>
                  <span class="icon is-small is-right">
                    <i class="fas fa-check"></i>
                  </span>
                </div>

              </div>
              <div class="field">
                <label class="label">Password</label>
                <div class="field has-addons">
                  <div class="control is-expanded">
                    <input required class="input" onchange="checkPassword();" maxlength="255" type="password" placeholder="Password" name="password1">
                  </div>
                </div>
              </div>
              <div class="field">
                <label class="label">Ripeti password</label>
                <div class="field has-addons">
                  <div class="control is-expanded">
                    <input required class="input" onchange="checkPassword();" minlength="6" maxlength="255" type="password" placeholder="Ripeti password" name="password2">
                  </div>
                </div>
              </div>
              <div class="field">
                <label class="label">Email</label>
                <div class="control has-icons-left has-icons-right">
                  <input required class="input" onchange="checkEmail(this);" minlength="6" maxlength="255" type="email" placeholder="Email" name="email" <?php if (isset($_POST['email'])) {print('value="' . $_POST['email'] . '"');}?>>
                  <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                  </span>
                  <span class="icon is-small is-right">
                    <i class="fas fa-exclamation-triangle"></i>
                  </span>
                </div>
              </div>

              <div class="field">
                <label class="label">Regione <small>(facoltativo)</small></label>
                <div class="control">
                  <div class="select">
                    <select name="regione">
                      <option disabled selected>Seleziona regione</option>
                      <option>Abruzzo</option>
                      <option>Basilicata</option>
                      <option>Calabria</option>
                      <option>Campania</option>
                      <option>Emilia-Romagna</option>
                      <option>Friuli-Venezia Giulia</option>
                      <option>Lazio</option>
                      <option>Liguria</option>
                      <option>Lombardia</option>
                      <option>Marche</option>
                      <option>Molise</option>
                      <option>Piemonte</option>
                      <option>Puglia</option>
                      <option>Sardegna</option>
                      <option>Sicilia</option>
                      <option>Toscana</option>
                      <option>Trentino-Alto Adige</option>
                      <option>Umbria</option>
                      <option>Valle d'Aosta</option>
                      <option>Veneto</option>
                    </select>
                  </div>
                </div>
              </div>

              <hr>

              <div class="field">
                <div class="control">
                  <label class="checkbox">
                    <input required type="checkbox" name="terminiCondizioni">
                    Acconsento ai <a href="https://youtu.be/f5d8pVg3Qtg">termini e condizioni</a>
                  </label>
                </div>
              </div>

              <div class="field">
                <div class="control">
                  <label class="checkbox">
                    <input type="checkbox" name="newsletter">
                    Iscrivimi alla <strong>newsletter</strong> <small>(facoltativo)</small>
                  </label>
                </div>
              </div>

              <hr>

              <div class="level">
                <div class="level-item has-text-centered">
                  <div class="field is-grouped">
                    <div class="control">
                      <button type="submit" class="button is-link">Registrati</button>
                    </div>
                    <div class="control">
                      <button type="reset" class="button is-text">Annulla</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="level">
                <div class="level-item has-text-centered">
                  <a href="index.php">Torna alla home</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>