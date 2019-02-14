<!DOCTYPE html>
<html lang="it">

<?php
  require ('../lib/head.php');
  drawHead("Profilo", "Gestione attivitá", array(
    '<link rel="stylesheet" href="assets/css/registration.css">'
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
            <form id="Registrazione">
              <div class="field">
                <label class="label">Name</label>
                <div class="control">
                  <input required class="input" type="text" placeholder="Nome">
                </div>
              </div>
              <div class="field">
                <label class="label">Cognome</label>
                <div class="control">
                  <input required class="input" type="text" placeholder="Cognome">
                </div>
              </div>
              <div class="field">
                <label class="label">Username</label>
                <div class="control has-icons-left has-icons-right">
                  <!--input is-correct quando è disponibile il bordo diventa verde
                  input is-warning giallo
                  input is-danger rosso
                  input is-info blu-->
                  <input required class="input" type="text" placeholder="Username">
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
                    <input required class="input" type="password" placeholder="Password">
                  </div>
                </div>
              </div>
              <div class="field">
                <label class="label">Ripeti password</label>
                <div class="field has-addons">
                  <div class="control is-expanded">
                    <input required class="input" type="password" placeholder="Ripeti password">
                  </div>
                </div>
              </div>
              <div class="field">
                <label class="label">Email</label>
                <div class="control has-icons-left has-icons-right">
                  <input required class="input" type="email" placeholder="Email">
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

              <hr>

              <div class="field">
                <div class="control">
                  <label class="checkbox">
                    <input required type="checkbox">
                    Acconsento ai <a href="https://youtu.be/f5d8pVg3Qtg">termini e condizioni</a>
                  </label>
                </div>
              </div>

              <div class="field">
                <div class="control">
                  <label class="checkbox">
                    <input type="checkbox">
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