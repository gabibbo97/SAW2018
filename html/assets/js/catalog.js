function updateCategories (button) {

  "use strict";

  // Scambia le classi
  button.classList.toggle("is-outlined");
  button.classList.toggle("is-danger");

  // Chiama la ricerca
  unifiedSearch ()

}

function updatePrice(newPrice) {

  "use strict";

  // Prendi l'elemento che mostra il prezzo
  const priceTag = document.getElementsByTagName("output")[0];

  // Imposta il prezzo al numero, con due cifre decimali
  priceTag.textContent = `${Number(newPrice).toFixed(2)} euro`;

  // Chiama la ricerca
  unifiedSearch ();

}

function searchByName() {

  "use strict";

  // Prendi la barra di ricerca
  const searchBar = document.getElementById("searchBar");

  // Prendi il pulsante di ricerca
  const searchButton = document.getElementById("searchButton");

  // Se il testo della barra é troppo corto esci
  if (searchBar.value.length < 1) {

    window.alert("Inserisci il termine di ricerca");
    return;

  }

  // Cambia il colore al tasto
  searchButton.classList.toggle("is-danger");

  if (searchButton.textContent.trim() === "Cerca") {
    // Imposta la casella di ricerca su disabilitata
    searchBar.disabled = true;

    // Cambia il testo del pulsante
    searchButton.textContent = "Mostra tutte";
  } else {
    // Imposta la casella di ricerca su abilitata
    searchBar.disabled = false;

    // Resetta il contenuto della casella di ricerca
    searchBar.textContent = '';

    // Cambia il testo del pulsante
    searchButton.textContent = "Cerca";
  }

  // Chiama la ricerca
  unifiedSearch ();

}

function closeImagePreview() {

  "use strict";

  // Prendi il modale
  const imagePreview = document.getElementById("imagePreview");

  // Nascondilo
  imagePreview.classList.toggle("is-active");

}

function openImagePreview(cardImage) {

  // Prendi il modale
  const imagePreview = document.getElementById("imagePreview");

  // Prendi l'immagine
  const innerImage = cardImage.children[0].children[0];

  // Prendi l'immagine dentro al modale
  const modalImage = imagePreview.children[1].children[0].children[0];

  // Copia le proprietá dall'immagine cliccata
  modalImage.alt = innerImage.alt;
  modalImage.src = innerImage.src;

  // Effettua il cambio solo quando l'immagine é effettivamente caricata nell'elemento
  modalImage.onload = () => {

    // Mostralo
    imagePreview.classList.toggle("is-active");

  }

}

function unifiedSearch () {

  "use strict";

  // Prendi gli elementi del form di ricerca
  const searchBar = document.getElementById("searchBar");
  const searchButton = document.getElementById("searchButton");
  const searchTerm = searchBar.value.toLowerCase().trim(); // Prendi il termine di ricerca

  // Prendi il selettore del prezzo
  const priceSelector = document.getElementById('priceSelector');

  // Prendi i pulsanti selezionati
  const categoriesButtons = Array.from(document.querySelectorAll('a[class~="is-danger"]:not(#searchButton)'));
  const selectedCategories = categoriesButtons.map((button) => button.textContent);

  // Prendi tutte le cards
  const cards = Array.from(document.querySelectorAll(".columns > .card"));

  const cardsToShow = cards
    .filter((card) => {
      if (searchBar.value.length < 1) {
        // Se non é stato inserito nulla accetta tutti gli elementi
        return true;
      } else if (searchButton.textContent == 'Cerca') {
        // Se non é stato premuto cerca accetta tutti gli elementi
        return true;
      } else {
        // Ricerca per nome
        return card
          .children[1]                // Seleziona la parte sotto la foto
          .children[0]                // Seleziona il paragrafo con il nome
          .textContent                // Seleziona il testo del nome
          .toLowerCase()              // Minuscolo
          .search(searchTerm) !== -1  // Confronta con il testo cercato
      }
    })
    .filter((card) => { // Ricerca per prezzo
      return Number(card            // Con il cast a `Number` converto tutto a numero
        .children[1]                // Seleziona la parte sotto la foto
        .children[2]                // Seleziona il paragrafo con il prezzo
        .textContent.split(' ')[0]  // Separa il numero da 'euro'
      ) <= priceSelector.value      // Controllo il prezzo
    })
    .filter((card) => {
      if (selectedCategories.length == 0)
        // Se non é stata selezionata nessuna categoria accetta tutti gli elementi
        return true;
      else
        return selectedCategories.includes(card.children[1].children[1].textContent);
    });
  
  // Mostra tutte le card
  cardsToShow
    .forEach((card) => { card.style.display = 'block'; });
  // Nascondi tutte le card
  cards
    .filter((card) => { return ! cardsToShow.includes(card); })
    .forEach((card) => { card.style.display = 'none'; });
}