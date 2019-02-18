<div id="blog" class="section">
  <form method="POST" action="blog-article.php?new=yes">
    <div class="field">
      <label class="label">Titolo del post</label>
      <div class="control">
        <input class="input is-primary" type="text" placeholder="Titolo del post" name="titolo" required>
      </div>
    </div>
    <div class="field">
      <label class="label">Sottotitolo del post</label>
      <div class="control">
        <input class="input is-primary" type="text" placeholder="Sottotitolo del post" name="sottotitolo">
      </div>
    </div>
    <div class="field">
      <label class="label">Testo del post</label>
      <div class="control">
        <textarea class="textarea is-primary" placeholder="Testo del post" rows="15" required name="testo"></textarea>
      </div>
    </div>
    <div class="field">
      <label class="label">Tags <small>(separa i tags con la virgola)</small></label>
      <div class="control">
        <input class="input is-primary" type="text" placeholder="Tags" name="tags">
      </div>
    </div>
    <div class="field">
      <button type="submit" class="button is-warning is-fullwidth">Pubblica</button>
    </div>
  </form>
</div>
<div id="newsletter" class="section">
  <form method="POST" action="profile.php?newsletter=yes">
    <div class="field">
      <label class="label">Oggetto</label>
      <div class="control">
        <input class="input is-primary" type="text" placeholder="Oggetto della mail" required name="oggetto">
      </div>
    </div>
    <div class="field">
      <label class="label">Testo dell'email</label>
      <div class="control">
        <textarea class="textarea is-primary" placeholder="Testo dell'email" rows="15" required name="email"></textarea>
      </div>
    </div>
    <div class="field">
      <button type="submit" class="button is-warning is-fullwidth">Invia</button>
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
        <?php
        $usersQuery = $db->prepare('SELECT username,nome,cognome,email,regione,tipoUtente FROM utente ORDER BY LENGTH(username), username');
        $usersQuery->execute();
        while (($user = $usersQuery->fetch(PDO::FETCH_ASSOC))) {
          print('<tr>');
          print('<td>' . $user['username'] . '</td>');
          print('<td>' . $user['email'] . '</td>');
          print('<td>' . $user['nome'] . '</td>');
          print('<td>' . $user['cognome'] . '</td>');
          print('<td>' . $user['regione'] . '</td>');
          if ($user['tipoUtente'] != 'ADMIN')
            print('<td><a href="profile.php?editUser=' . urlencode($user['username']) . '&action=setAdmin" class="button">Rendi amministratore</a></td>');
          else
            print('<td><a href="profile.php?editUser=' . urlencode($user['username']) . '&action=setUser" class="button">Rendi utente</a></td>');
          print('</tr>');
        }
        ?>
      </tbody>
    </table>
  </form>
</div>