/**
 * @param {*} button L'oggetto button con dentro l'icona
 * @param {*} inputID L'ID dell'elemento che contiene la password
 */
function showPassword (button, inputID) {

  // Rende errore codice mal scritto
  "use strict";

  // Prendi l'elemento della password
  const password = document.getElementById(inputID);

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
