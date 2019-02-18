<header>
  <nav class="navbar is-primary">
    <div class="navbar-brand">
      <a class="navbar-item" href="index.php">
        <img src="assets/images/rubber-duck-icon-logo.png" width="112" height="28" alt="Il nostro logo">
      </a>
      <a class="navbar-burger" onclick="headerOpenHamburgerMenu()">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <div class="navbar-menu">
      <div class="navbar-start">
        <a href="about.php" class="navbar-item">
          <span class="icon">
            <i class="fas fa-info"></i>
          </span>
          <span>Chi siamo</span>
        </a>
        <a href="blog.php" class="navbar-item">
          <span class="icon">
            <i class="far fa-newspaper"></i>
          </span>
          <span>Blog</span>
        </a>
        <a href="catalog.php" class="navbar-item">
          <span class="icon">
            <i class="fas fa-book-open"></i>
          </span>
          <span>Catalogo</span>
        </a>
      </div>
      <div class="navbar-end">
      <?php
        if (isset($_SESSION['username'])) {
          print('<div class="navbar-item is-hidden-touch">');
          print('<div class="level">');
          print('<div class="level-left">');
          print('<div class="level-item">');
          print('<span>Ciao, <a class="has-text-black" href="profile.php">'.htmlspecialchars($_SESSION['username']).'</a></span>');
          print('<span class="divider"></span>');
          print('</div>');
          print('</div>');
          print('<div class="level-right">');
          print('<figure class="level-item image is-32by32">');
          print('<img alt="Immagine del profilo" class="is-rounded" src="profile-picture.php">');
          print('</figure>');
          print('</div>');
          print('</div>');
          print('</div>');
          print('<a href="profile.php?logout=yes" class="navbar-item">Esci</a>');
          print('<a href="profile.php" class="navbar-item is-hidden-desktop">');
          print('<span class="icon">');
          print('<i class="fas fa-user"></i>');
          print('</span>');
          print('<span>Profilo</span>');
          print('</a>');
        } else {
          print('<div class="buttons is-hidden-touch">');
          print('<div class="navbar-item">');
          print('<a href="registration.php" class="button is-link">');
          print('<strong>Registrati</strong>');
          print('</a>');
          print('<a id="login-button-desktop" class="button is-light" onclick="headerOpenLoginBar()">Accedi</a>');
          print('</div>');
          print('</div>');
          print('</div>');
          print('<a href="registration.php" class="navbar-item is-hidden-desktop">');
          print('<span class="icon">');
          print('<i class="fas fa-user-plus"></i>');
          print('</span>');
          print('<span>Registrati</span>');
          print('</a>');
          print('<a id="login-link-mobile" class="navbar-item is-hidden-desktop" onclick="headerOpenLoginBar()">');
          print('<span class="icon">');
          print('<i class="fas fa-sign-in-alt"></i>');
          print('</span>');
          print('<span>Accedi</span>');
          print('</a>');
        }
      ?>
      </div>
    </div>
  </nav>
  <div id="login-bar" class="hero is-primary">
    <div class="hero-body">
      <div class="container">
        <form method="POST" action="profile.php">
          <div class="field is-horizontal">
            <div class="field-body">
              <div class="field">
                <p class="control is-expanded has-icons-left">
                  <input class="input" type="text" required placeholder="Username" name="username">
                  <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                  </span>
                </p>
              </div>
              <div class="field has-addons">
                <p class="control has-icons-left is-expanded">
                  <input id="loginPassword" class="input" type="password" required placeholder="Password" name="password">
                  <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                  </span>
                </p>
                <p class="control">
                  <a class="button" onclick="showLoginPassword(this)">
                    <span class="icon">
                      <i class="far fa-eye"></i>
                    </span>
                  </a>
                </p>
              </div>
              <div class="control">
                <button class="button is-fullwidth">Accedi</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</header>