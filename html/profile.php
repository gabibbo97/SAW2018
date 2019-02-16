<?php
  session_start();

  // Login
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    require ('../lib/db.php');
    $db = dbConnect();

    $loginQuery = $db->prepare('SELECT password, tipoUtente FROM utente WHERE username = :username');
    $loginQuery->bindParam(":username", $_POST['username']);
    $loginQuery->execute();
    $password_hash = $loginQuery->fetchColumn(0);

    if ($password_hash == FALSE) {
      require('../lib/error.php');
      drawError('Username o password errati');
    } else {
      if (password_verify($_POST['password'], $password_hash)) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['role'] = $loginQuery->fetchColumn(1);
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
?>
<?php
  require ('../lib/head.php');
  drawHead("Profilo", "Gestione attivitá", array(
    '<link rel="stylesheet" href="assets/css/profile.css">',
    '<script src="assets/js/profile.js"></script>'
  ));
?>

<body>
  <?php require ('../lib/header.php'); ?>
  <main>
    <div class="section">
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
      <form class="columns">
        <div class="column is-3">
          <p class="title">Immagine del profilo</p>
          <p class="subtitle">Puoi caricare la tua foto qui</p>
        </div>
        <div class="column">
          <nav class="columns is-vcentered">
            <div class="column is-narrow has-text-centered">
              <figure class="image is-128x128">
                <img alt="Immagine del profilo" class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
              </figure>
            </div>
            <div class="column">
              <strong>Carica una nuova foto</strong>
              <div class="file">
                <label class="file-label">
                  <input class="file-input" type="file" name="resume">
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
            </div>
          </nav>
        </div>
      </form>
      <hr>
      <form class="columns">
        <div class="column is-3">
          <p class="title">Dati personali</p>
          <p class="subtitle">Queste sono le informazioni del tuo profilo</p>
        </div>
        <div class="column">
          <div class="field">
            <label class="label">Name</label>
            <div class="control">
              <input required class="input is-primary" type="text" placeholder="Nome">
            </div>
          </div>
          <div class="field">
            <label class="label">Cognome</label>
            <div class="control">
              <input required class="input is-primary" type="text" placeholder="Cognome">
            </div>
          </div>
          <div class="field">
            <label class="label">Username</label>
            <div class="control has-icons-left has-icons-right">
              <!--input is-correct quando è disponibile il bordo diventa verde
                        input is-warning giallo
                        input is-danger rosso
                        input is-info blu-->
              <input required class="input is-primary" type="text" placeholder="Username">
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
              <input required class="input is-primary" type="email" placeholder="Email">
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
                <select name="Regioni">
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
                  <option>Molisa</option>
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
      <form class="columns">
        <div class="column is-3">
          <p class="title">Credenziali di accesso</p>
          <p class="subtitle">Cambia qui la tua password</p>
        </div>
        <div class="column">
          <label class="label">Vecchia password</label>
          <div class="field has-addons">
            <p class="control has-icons-left is-expanded">
              <input id="oldPassword" class="input is-primary" type="password" placeholder="Vecchia password">
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
                <input required class="input is-primary" type="password" placeholder="Password">
              </div>
            </div>
          </div>
          <div class="field">
            <label class="label">Ripeti nuova password</label>
            <div class="field has-addons">
              <div class="control is-expanded">
                <input required class="input is-primary" type="password" placeholder="Ripeti password">
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
      <form class="columns">
        <div class="column is-3">
          <p class="title">Newsletter</p>
          <p class="subtitle">Modifica le impostazioni sul ricevimento della newsletter</p>
        </div>
        <div class="column">
          <div class="control is-size-5">
            <label class="radio">
              <input type="radio" name="answer">
              <strong>Iscrivimi</strong> alla newsletter
            </label>
            <br>
            <label class="radio">
              <input type="radio" name="answer">
              <strong>Disiscrivimi</strong> dalla newsletter
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
      <div id="deleteModal" class="modal">
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
            <button class="button is-danger">S&iacute; sono sicuro</button>
            <button class="button" onclick="closeDeleteModal()">Annulla</button>
          </footer>
        </div>
      </div>
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
