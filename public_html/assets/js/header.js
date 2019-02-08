function headerOpenHamburgerMenu () {

  // Rende errore codice mal scritto
  "use strict";

  // Prendi navbar-menu
  const navbar = document.getElementsByClassName("navbar-menu")[0];
  // Prendi navbar-burger
  const burger = document.getElementsByClassName("navbar-burger")[0];

  // Funzione che aggiunge/toglie is-active
  function toggleActive (element) {

    if (element.classList.contains("is-active")) {

      element.classList.remove("is-active");

    } else {

      element.classList.add("is-active");

    }

  }

  // Invoca la funzione sul menú e sul pulsante
  toggleActive(navbar);
  toggleActive(burger);

}

// Mostra nascondi la barra e cambia tutti i pulsanti associati
function headerOpenLoginBar () {

  // Rende errore codice mal scritto
  "use strict";

  // Pulsanti accedi
  const loginDesktop = document.getElementById("login-button-desktop");
  const loginMobile = document.getElementById("login-link-mobile");

  // Barra di login
  const loginBar = document.getElementById("login-bar");

  if (loginBar.style.display === "block") {

    // Nascondi la barra
    loginBar.style.display = "none";
    // Cambia il pulsante desktop
    loginDesktop.textContent = "Accedi";
    loginDesktop.classList.replace("is-danger", "is-light");
    // Cambia il link mobile
    loginMobile.children[1].textContent = "Accedi";

  } else {

    // Mostra la barra
    loginBar.style.display = "block";
    // Cambia il pulsante desktop
    loginDesktop.textContent = "Chiudi";
    loginDesktop.classList.replace("is-light", "is-danger");
    // Cambia il link mobile
    loginMobile.children[1].textContent = "Chiudi";

  }

}

function showPassword (button) {

  // Rende errore codice mal scritto
  "use strict";

  // Prendi l'elemento della password
  const password = document.getElementById("loginPassword");

  // Prendi l'icona
  const icon = button.children[0].children[0];

  // Cambia il tipo dell'input
  if (password.type === "password") {

    // Imposta il testo su visibile
    password.type = "text";

    // Cambia icona
    icon.classList.toggle("fa-eye-slash");

  } else {

    // Imposta il testo su nascosto
    password.type = "password";

    // Cambia icona
    icon.classList.toggle("fa-eye");

  }

}
