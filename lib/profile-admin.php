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
      <label class="label">Tag preesistenti</label>
      <div id="existingTags" class="field is-grouped is-grouped-multiline">
        <?php
          $tagsQuery = $db->query('SELECT nome FROM tag ORDER BY LENGTH (nome), nome');
          if ($tagsQuery->rowCount() != 0) {
            while (($tag = $tagsQuery->fetch(PDO::FETCH_ASSOC))) {
              print('<div class="control">');
              print('<div class="tags has-addons">');
              print('<div class="tag">'.$tag['nome'].'</div>');
              print('<div class="tag"><input type="checkbox" onclick="updateTags()"></div>');
              print('</div>');
              print('</div>');
            }
          } else {
            print('<small>Nessun tag presente</small>');
          }
        ?>
      </div>
    </div>
    <br>
    <input id="tagsHiddenField" type="hidden" name="tags" value="{}">
    <div class="field">
      <label class="label">Tags nuovi</label>
    </div>
    <div id="newTagField" class="field has-addons">
      <div class="control">
        <input class="input is-primary" type="text" placeholder="Nome del tag">
      </div>
      <div class="control">
        <a onclick="addNewTag()" class="button is-outlined is-primary">
          Aggiungi
        </a>
      </div>
    </div>
    <div class="field">
      <div id="addedTags" class="field is-grouped is-grouped-multiline">
      </div>
    </div>
    <br>
    <div class="field">
      <button type="submit" class="button is-warning is-fullwidth">Pubblica</button>
    </div>
  </form>
</div>
<div id="tags" class="section">
  <form method="POST">
    <table class="table is-striped is-fullwidth">
      <thead>
        <tr>
          <td>Tag</td>
          <td>Descrizione</td>
        </tr>
      </thead>
      <tbody>
        <?php
          $tagsQuery = $db->query('SELECT nome, descrizione FROM tag ORDER BY nome');
          while (($tag = $tagsQuery->fetch(PDO::FETCH_ASSOC))) {
            print('<tr>');

            print('<td>'.$tag['nome'].'</td>');

            print('<td>');
            print('<div class="field has-addons">');

            print('<div class="control is-expanded">');
            if (is_null($tag['descrizione']))
              print('<input name="'.$tag['nome'].'" class="input" type="text" placeholder="Descrizione del tag">');
            else
              print('<input name="'.$tag['nome'].'" class="input" type="text" placeholder="Descrizione del tag" value="'.$tag['descrizione'].'">');
            print('</div>');

            print('<div class="control">');
            if (is_null($tag['descrizione']))
              print('<input type="submit" formaction="?editTag=yes&tagName='.urlencode($tag['nome']).'" class="button" value="Aggiungi descrizione">');
            else
              print('<input type="submit" formaction="?editTag=yes&tagName='.urlencode($tag['nome']).'" class="button" value="Cambia descrizione">');
            print('</div>');

            print('</div>');
            print('</td>');

            print('</tr>');
          }
        ?>
      </tbody>
    </table>
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
      <div class="notification is-primary">
        <p><strong>Sostituzioni disponibili:</strong></p>
        <p><strong>{{ nome }}</strong>: Il nome del destinatario</p>
        <p><strong>{{ cognome }}</strong>: Il cognome del destinatario</p>
      </div>
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
    if ($user['tipoUtente'] != 'ADMIN') {
        print('<td><a href="profile.php?editUser=' . urlencode($user['username']) . '&action=setAdmin" class="button">Rendi amministratore</a></td>');
    } else {
        print('<td><a href="profile.php?editUser=' . urlencode($user['username']) . '&action=setUser" class="button">Rendi utente</a></td>');
    }

    print('</tr>');
}
?>
      </tbody>
    </table>
  </form>
</div>