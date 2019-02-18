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
            $template = file_get_contents('header-logged-in.html', TRUE);
            $template = str_replace('{{ username }}', htmlspecialchars($_SESSION['username']), $template);
            print($template);
        } else {
            print(file_get_contents('header-not-logged-in.html', TRUE));
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