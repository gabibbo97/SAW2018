<?php
  session_start();

  // Login
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    require ('../lib/db.php');
    $db = dbConnect();

    $loginQuery = $db->prepare('SELECT password, tipoUtente FROM utente WHERE username = :username');
    $loginQuery->bindParam(":username", $_POST['username']);
    $loginQuery->execute();

    $userDetail = $loginQuery->fetch(PDO::FETCH_ASSOC);

    if ($userDetail == FALSE) {
      require('../lib/error.php');
      drawError('Username o password errati');
    } else {
      if (password_verify($_POST['password'], $userDetail['password'])) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['role'] = $userDetail['tipoUtente'];
        header('Location: profile.php');
        die();
      } else {
        require('../lib/error.php');
        drawError('Username o password errati');
      }
    }
  }

  // Mostra errore se l'utente non é loggato
  if (!isset($_SESSION['username'])) {
    require ('../lib/error.php');
    drawError("Area riservata, effettuare l'accesso");
  }

  // Logout
  if (isset($_GET['logout']) && $_GET['logout'] == 'yes') {
    session_destroy();
    $_SESSION = array();
    header("Location: index.php");
    die();
  }

  // Gestione immagine del profilo
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['uploadPicture'])) {
    require ('../lib/error.php');

    // Controlla se é presente l'immagine
    if ($_FILES['profilePicture']['error'] != UPLOAD_ERR_OK)
      drawError("Nessuna immagine caricata");
    
    // Controlla la dimensione
    if ($_FILES['profilePicture']['size'] > 200000)
      drawError("Immagine troppo grande, hai caricato una immagine di ".(round($_FILES['profilePicture']['size'] / 1024))."KB e il massimo ammesso é 200KB");
    
    // Controlla il tipo dell'immagine
    if (!preg_match('/^image/', mime_content_type($_FILES['profilePicture']['tmp_name'])))
      drawError("Non é stata caricata una immagine ben formata");
    
    // Carica l'immagine
    $uploadDir = '../images';
    if (!is_dir($uploadDir))
      mkdir($uploadDir, 0666);
    
    $fileName = substr(sha1($_SESSION['username']), 0, 20);
    if(!move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadDir.'/'.$fileName))
      drawError("C'è stato un errore durante l'impostazione della tua immagine");
    
    require ('../lib/db.php');
    $db = dbConnect();
    $profileImageQuery = $db->prepare('UPDATE utente SET percorsoImmagine = :percorso WHERE username = :username');
    $profileImageQuery->bindParam(":username", $_SESSION['username']);
    $profileImageQuery->bindParam(":percorso", $fileName);
    $profileImageQuery->execute();
    header("Location: profile.php");
    die();
  }

  // Gestione dati utente
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['updateProfile'])) {
    require ('../lib/error.php');
    
    // Controllo email
    if (!isset($_POST['email']))
      drawError("Email assente");
    if (strlen($_POST['email']) < 6)
      drawError("Email troppo corta");
    if (strlen($_POST['email']) > 255)
      drawError("Email troppo lunga");
    if (!preg_match("/.+@.+\..+/", $_POST['email']))
      drawError("Email con caratteri non ammessi");
    
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
        $regione = NULL;
        break;
    }

    require ('../lib/db.php');
    $db = dbConnect();
    $profileImageQuery = $db->prepare('UPDATE utente SET email = :email, regione = :regione WHERE username = :username');
    $profileImageQuery->bindParam(":username", $_SESSION['username']);
    $profileImageQuery->bindParam(":email", $_POST['email']);
    $profileImageQuery->bindParam(":regione", $regione);
    $profileImageQuery->execute();
    header("Location: profile.php");
    die();
  }

  // Gestione update password
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['updatePassword'])) {
    require ('../lib/db.php');
    $db = dbConnect();

    $getPasswordQuery = $db->prepare('SELECT password FROM utente WHERE username = :username');
    $getPasswordQuery->bindParam(":username", $_SESSION['username']);
    $getPasswordQuery->execute();

    $userDetail = $getPasswordQuery->fetch(PDO::FETCH_ASSOC);

    require('../lib/error.php');

    if (password_verify($_POST['oldPassword'], $userDetail['password'])) {
      // Controllo password inserite
      if (!isset($_POST['password1']))
        drawError("Password assente");
      if (strlen($_POST['password1']) < 6)
        drawError("Password troppo corta");
      if (strlen($_POST['password1']) > 255)
        drawError("Password troppo lunga");
      if ($_POST['password1'] != $_POST['password2'])
        drawError("Le password non corrispondono");
      
      // Aggiornamento password
      $updatePasswordQuery = $db->prepare('UPDATE utente SET password = :password WHERE username = :username');
      $updatePasswordQuery->bindParam(":username", $_SESSION['username']);
      $updatePasswordQuery->bindParam(":password", password_hash($_POST['password1'], PASSWORD_DEFAULT));
      $updatePasswordQuery->execute();
      header("Location: profile.php");
      die();
    } else {
      drawError('Password errata');
    }
  }

  // Gestione update newsletter
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['updateNewsletter'])) {
    require ('../lib/db.php');
    $db = dbConnect();

    $updateRegionQuery = $db->prepare('UPDATE utente SET riceveNewsletter = :riceveNewsletter WHERE username = :username');
    $updateRegionQuery->bindParam(":username", $_SESSION['username']);
    $updateRegionQuery->bindParam(":riceveNewsletter", $riceveNewsletter);

    if ($_POST['newsletter'] == 'on') {
      $riceveNewsletter = 1;
    } else {
      $riceveNewsletter = 0;
    }

    $updateRegionQuery->execute();

    header("Location: profile.php");
    die();
  }

  // Gestione cancellazione account
  if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {

    require ('../lib/db.php');
    $db = dbConnect();

    $updateRegionQuery = $db->prepare('DELETE FROM utente WHERE username = :username');
    $updateRegionQuery->bindParam(":username", $_SESSION['username']);
    $updateRegionQuery->execute();

    session_destroy();
    $_SESSION = array();

    header("Location: index.php");
    die();
  }

  // Ottieni i dati dell'utente
  require ('../lib/db.php');
  $db = dbConnect();
  $userDetailsQuery = $db->prepare('SELECT nome,cognome,email,percorsoImmagine,riceveNewsletter,regione FROM utente WHERE username = :username');
  $userDetailsQuery->bindParam(":username", $_SESSION['username']);
  $userDetailsQuery->execute();
  $userDetails = $userDetailsQuery->fetch(PDO::FETCH_ASSOC);

  require ('../lib/head.php');
  drawHead("Profilo", "Gestione attivitá", array(
    '<link rel="stylesheet" href="assets/css/profile.css">',
    '<script src="assets/js/profile.js"></script>',
    '<script src="assets/js/registration.js"></script>'
  ));
?>

<body>
  <?php require ('../lib/header.php'); ?>
  <main>
    <div class="section" <?php if ($_SESSION['role'] != 'ADMIN') { print('style="display: none"'); } ?>>
      <div class="tabs is-centered is-medium is-toggle">
        <ul>
          <li class="is-active">
            <a onclick="menu(this, 'profile')">
              <span class="icon is-small"><i class="fas fa-user" aria-hidden="true"></i></span>
              <span>Profilo</span>
            </a>
          </li>
          <li>
            <a onclick="menu(this, 'blog')">
              <span class="icon is-small"><i class="far fa-newspaper" aria-hidden="true"></i></span>
              <span>Blog</span>
            </a>
          </li>
          <li>
            <a onclick="menu(this, 'newsletter')">
              <span class="icon is-small"><i class="far fa-envelope-open" aria-hidden="true"></i></span>
              <span>Newsletter</span>
            </a>
          </li>
          <li>
            <a onclick="menu(this, 'users')">
              <span class="icon is-small"><i class="fas fa-users" aria-hidden="true"></i></span>
              <span>Utenti</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div id="profile" class="section">
      <form class="columns" method="POST" action="profile.php?uploadPicture=yes" enctype="multipart/form-data">
        <div class="column is-3">
          <p class="title">Immagine del profilo</p>
          <p class="subtitle">Puoi caricare la tua foto qui</p>
        </div>
        <div class="column">
          <nav class="columns is-vcentered">
            <div class="column is-narrow has-text-centered">
              <figure class="image is-128x128">
                <img alt="Immagine del profilo" class="is-rounded" src="profile-picture.php">
              </figure>
            </div>
            <div class="column">
              <strong>Carica una nuova foto</strong>
              <div class="file">
                <label class="file-label">
                  <input class="file-input" type="file" accept="image/*" name="profilePicture">
                  <span class="file-cta">
                    <span class="file-icon">
                      <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                      Scegli un file
                    </span>
                  </span>
                </label>
              </div>
              <small>La dimensione massima concessa é 200KB.</small>
              <div class="control">
                <button type="submit" class="button is-warning">Carica immagine</button>
              </div>
            </div>
          </nav>
        </div>
      </form>
      <hr>
      <form class="columns" method="POST" action="profile.php?updateProfile=yes">
        <div class="column is-3">
          <p class="title">Dati personali</p>
          <p class="subtitle">Queste sono le informazioni del tuo profilo</p>
        </div>
        <div class="column">
          <div class="field">
            <label class="label">Name</label>
            <div class="control">
              <input required class="input is-primary" type="text" disabled placeholder="Nome" name="nome" value="<?php print(htmlspecialchars($userDetails['nome'])); ?>">
            </div>
          </div>
          <div class="field">
            <label class="label">Cognome</label>
            <div class="control">
              <input required class="input is-primary" type="text" disabled placeholder="Cognome" name="cognome" value="<?php print(htmlspecialchars($userDetails['cognome'])); ?>">
            </div>
          </div>
          <div class="field">
            <label class="label">Username</label>
            <div class="control has-icons-left has-icons-right">
              <!--input is-correct quando è disponibile il bordo diventa verde
                        input is-warning giallo
                        input is-danger rosso
                        input is-info blu-->
              <input required class="input is-primary" type="text" disabled placeholder="Username" name="username" value="<?php print(htmlspecialchars($_SESSION['username'])); ?>">
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
              <span class="icon is-small is-right">
                <i class="fas fa-check"></i>
              </span>
            </div>

          </div>
          <div class="field">
            <label class="label">Email</label>
            <div class="control has-icons-left has-icons-right">
              <input required class="input is-primary" type="email" onchange="checkEmail(this, '<?php print($userDetails['email']); ?>');" minlength="6" maxlength="255" placeholder="Email" name="email" value="<?php print(htmlspecialchars($userDetails['email'])); ?>">
              <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
              </span>
              <span class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
              </span>
            </div>
          </div>

          <div class="field">
            <label class="label">Regione</label>
            <div class="control">
              <div class="select">
                <select name="regione">
                  <option <?php if ($userDetails['regione'] == NULL) { print('selected disabled'); } ?>><?php if ($userDetails['regione'] == NULL) { print('Seleziona regione'); } else { print('Rimuovi preferenza'); } ?></option>
                  <option <?php if ($userDetails['regione'] == 'Abruzzo') { print('selected'); } ?>>Abruzzo</option>
                  <option <?php if ($userDetails['regione'] == 'Basilicata') { print('selected'); } ?>>Basilicata</option>
                  <option <?php if ($userDetails['regione'] == 'Calabria') { print('selected'); } ?>>Calabria</option>
                  <option <?php if ($userDetails['regione'] == 'Campania') { print('selected'); } ?>>Campania</option>
                  <option <?php if ($userDetails['regione'] == 'EmiliaRomagna') { print('selected'); } ?>>Emilia-Romagna</option>
                  <option <?php if ($userDetails['regione'] == 'FriuliVeneziaGiulia') { print('selected'); } ?>>Friuli-Venezia Giulia</option>
                  <option <?php if ($userDetails['regione'] == 'Lazio') { print('selected'); } ?>>Lazio</option>
                  <option <?php if ($userDetails['regione'] == 'Liguria') { print('selected'); } ?>>Liguria</option>
                  <option <?php if ($userDetails['regione'] == 'Lombardia') { print('selected'); } ?>>Lombardia</option>
                  <option <?php if ($userDetails['regione'] == 'Marche') { print('selected'); } ?>>Marche</option>
                  <option <?php if ($userDetails['regione'] == 'Molise') { print('selected'); } ?>>Molise</option>
                  <option <?php if ($userDetails['regione'] == 'Piemonte') { print('selected'); } ?>>Piemonte</option>
                  <option <?php if ($userDetails['regione'] == 'Puglia') { print('selected'); } ?>>Puglia</option>
                  <option <?php if ($userDetails['regione'] == 'Sardegna') { print('selected'); } ?>>Sardegna</option>
                  <option <?php if ($userDetails['regione'] == 'Sicilia') { print('selected'); } ?>>Sicilia</option>
                  <option <?php if ($userDetails['regione'] == 'Toscana') { print('selected'); } ?>>Toscana</option>
                  <option <?php if ($userDetails['regione'] == 'TrentinoAltoAdige') { print('selected'); } ?>>Trentino-Alto Adige</option>
                  <option <?php if ($userDetails['regione'] == 'Umpria') { print('selected'); } ?>>Umbria</option>
                  <option <?php if ($userDetails['regione'] == 'ValleDAosta') { print('selected'); } ?>>Valle d'Aosta</option>
                  <option <?php if ($userDetails['regione'] == 'Veneto') { print('selected'); } ?>>Veneto</option>
                </select>
              </div>
            </div>
          </div>

          <br>

          <div class="field is-grouped">
            <div class="control">
              <button type="submit" class="button is-warning">Aggiorna i tuoi dati</button>
            </div>
            <div class="control">
              <button type="reset" class="button is-text">Annulla</button>
            </div>
          </div>
        </div>
      </form>
      <hr>
      <form class="columns" method="POST" action="profile.php?updatePassword=yes">
        <div class="column is-3">
          <p class="title">Credenziali di accesso</p>
          <p class="subtitle">Cambia qui la tua password</p>
        </div>
        <div class="column">
          <label class="label">Vecchia password</label>
          <div class="field has-addons">
            <p class="control has-icons-left is-expanded">
              <input id="oldPassword" class="input is-primary" type="password" placeholder="Vecchia password" name="oldPassword">
              <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
              </span>
            </p>
            <p class="control">
              <a class="button" onclick="showOldPassword(this)">
                <span class="icon">
                  <i class="far fa-eye"></i>
                </span>
              </a>
            </p>
          </div>
          <div class="field">
            <label class="label">Nuova password</label>
            <div class="field has-addons">
              <div class="control is-expanded">
                <input required class="input is-primary" type="password" placeholder="Password" name="password1">
              </div>
            </div>
          </div>
          <div class="field">
            <label class="label">Ripeti nuova password</label>
            <div class="field has-addons">
              <div class="control is-expanded">
                <input required class="input is-primary" type="password" placeholder="Ripeti password" name="password2">
              </div>
            </div>
          </div>
          <br>
          <div class="control">
            <button type="submit" class="button is-warning">Aggiorna la password</button>
          </div>
        </div>
      </form>
      <hr>
      <form class="columns" method="POST" action="profile.php?updateNewsletter=yes">
        <div class="column is-3">
          <p class="title">Newsletter</p>
          <p class="subtitle">Modifica le impostazioni sul ricevimento della newsletter</p>
        </div>
        <div class="column">
          <div class="control is-size-5">
            <label class="radio">
              <input type="radio" name="newsletter" value="on" <?php if ($userDetails['riceveNewsletter'] == 1) { print('checked'); } ?>>
              <strong>Iscritto</strong> alla newsletter
            </label>
            <br>
            <label class="radio">
              <input type="radio" name="newsletter" value="off" <?php if ($userDetails['riceveNewsletter'] == 0) { print('checked'); } ?>>
              <strong>Disiscritto</strong> dalla newsletter
            </label>
          </div>
          <br>
          <div class="control">
            <button type="submit" class="button is-warning">Aggiorna le preferenze</button>
          </div>
        </div>
      </form>
      <hr>
      <form class="columns is-vcentered">
        <div class="column is-3">
          <p class="title">Cancellazione account</p>
          <p class="subtitle">Elimina definitivamente il tuo profilo</p>
        </div>
        <div class="column">
          <div class="control">
            <a onclick="openDeleteModal()" class="button is-danger">Elimina per sempre il mio profilo</a>
          </div>
        </div>
      </form>
      <form id="deleteModal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title">Cancellazione account</p>
          </header>
          <div class="modal-card-body">
            <p>Sei veramente sicuro di voler eliminare permanentemente il tuo profilo?</p>
            <p>Tutti i tuoi dati saranno persi e non potrai piú recuperarli</p>
          </div>
          <footer class="modal-card-foot">
            <a href="?delete=yes" class="button is-danger">S&iacute; sono sicuro</button>
            <a class="button" onclick="closeDeleteModal()">Annulla</a>
          </footer>
        </div>
      </form>
    </div>
    <div id="blog" class="section">
      <form>
        <div class="field">
          <label class="label">Titolo del post</label>
          <div class="control">
            <input class="input is-primary" type="text" placeholder="Titolo del post">
          </div>
        </div>
        <div class="field">
          <label class="label">Testo del post</label>
          <div class="control">
            <textarea class="textarea is-primary" placeholder="Testo del post" rows="15"></textarea>
          </div>
        </div>
        <div class="field">
          <label class="label">Tags <small>(separa i tags con la virgola)</small></label>
          <div class="control">
            <input class="input is-primary" type="text" placeholder="Tags">
          </div>
        </div>
        <div class="field">
          <a class="button is-warning is-fullwidth">Pubblica</a>
        </div>
      </form>
    </div>
    <div id="newsletter" class="section">
      <form>
        <div class="field">
          <label class="label">Oggetto</label>
          <div class="control">
            <input class="input is-primary" type="text" placeholder="Oggetto della mail">
          </div>
        </div>
        <div class="field">
          <label class="label">Testo dell'email</label>
          <div class="control">
            <textarea class="textarea is-primary" placeholder="Testo dell'email" rows="15"></textarea>
          </div>
        </div>
        <div class="field">
          <a class="button is-warning is-fullwidth">Invia</a>
        </div>
      </form>
    </div>
    <div id="users" class="section">
      <form style="overflow-x:auto;">
        <table class="table is-striped is-fullwidth">
          <thead>
            <tr>
              <td>Username</td>
              <td>Email</td>
              <td>Nome</td>
              <td>Cognome</td>
              <td>Regione</td>
              <td>Azioni</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Babdidd</td>
              <td>ffsdasd</td>
              <td>dasdasdad</td>
              <td>gdgdgd</td>
              <td>gsdgsdgsg</td>
              <td>gsgdsgsdg</td>
            </tr>
            <tr>
              <td>Babdidd</td>
              <td>ffsdasd</td>
              <td>dasdasdad</td>
              <td>gdgdgd</td>
              <td>gsdgsdgsg</td>
              <td>gsgdsgsdg</td>
            </tr>
            <tr>
              <td>Babdidd</td>
              <td>ffsdasd</td>
              <td>dasdasdad</td>
              <td>gdgdgd</td>
              <td>gsdgsdgsg</td>
              <td>gsgdsgsdg</td>
            </tr>
            <tr>
              <td>Babdidd</td>
              <td>ffsdasd</td>
              <td>dasdasdad</td>
              <td>gdgdgd</td>
              <td>gsdgsdgsg</td>
              <td>gsgdsgsdg</td>
            </tr>
            <tr>
              <td>Babdidd</td>
              <td>ffsdasd</td>
              <td>dasdasdad</td>
              <td>gdgdgd</td>
              <td>gsdgsdgsg</td>
              <td>gsgdsgsdg</td>
            </tr>
            <tr>
              <td>Babdidd</td>
              <td>ffsdasd</td>
              <td>dasdasdad</td>
              <td>gdgdgd</td>
              <td>gsdgsdgsg</td>
              <td>gsgdsgsdg</td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
  </main>
  <?php require ('../lib/footer.php'); ?>
</body>

</html>
