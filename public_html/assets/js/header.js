function headerOpenHamburgerMenu () {

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
