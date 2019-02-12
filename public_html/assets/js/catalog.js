let categories = [];

function updateCategories (button) {

  "use strict";

  // Scambia le classi
  button.classList.toggle("is-outlined");
  button.classList.toggle("is-danger");

  // Prendi la mia categoria
  const category = button.textContent;

  // Prendi tutte le card
  const cards = Array.from(document.querySelectorAll(".columns > .card"));

  if (Array.from(button.classList).includes("is-danger")) {

    // Il pulsante é premuto
    categories.push(category);

  } else {

    // Il pulsante non é premuto
    categories = categories.filter((cat) => {
      
      return cat != category; 
    
    });

  }

  if (categories.length === 0) {

    // Mostra tutte le card
    cards.forEach((card) => { card.style.display = 'block'; });

  } else {

    // Nascondi le card la cui categoria non é selezionata
    cards.filter((card) => {

      return !categories.includes(card.children[1].children[1].textContent);

    }).forEach((card) => {

      card.style.display = 'none';

    });

    // Mostra le card la cui categoria é selezionata
    cards.filter((card) => {

      return categories.includes(card.children[1].children[1].textContent);

    }).forEach((card) => {

      card.style.display = 'block';

    });

  }

}

function updatePrice(newPrice) {

  "use strict";

  // Prendi l'elemento che mostra il prezzo
  const priceTag = document.getElementsByTagName("output")[0];

  // Imposta il prezzo al numero, con due cifre decimali
  priceTag.textContent = `${Number(newPrice).toFixed(2)} euro`;

  // Prendi tutte le card
  const cards = Array.from(document.querySelectorAll(".columns > .card"));

  // Seleziona tutte le card che vanno nascoste
  cards.filter((card) => {

    return Number(card            // Con il cast a `Number` converto tutto a numero
      .children[1]                // Seleziona la parte sotto la foto
      .children[2]                // Seleziona il paragrafo con il prezzo
      .textContent.split(' ')[0]  // Separa il numero da 'euro'
    ) > newPrice                  // Controllo il prezzo

  }).forEach((card) => {

    card.style.display = 'none';

  });

  // Seleziona tutte le card che vanno mostrate
  cards.filter((card) => {

    return Number(card            // Con il cast a `Number` converto tutto a numero
      .children[1]                // Seleziona la parte sotto la foto
      .children[2]                // Seleziona il paragrafo con il prezzo
      .textContent.split(' ')[0]  // Separa il numero da 'euro'
    ) <= newPrice                 // Controllo il prezzo

  }).forEach((card) => {

    card.style.display = 'block';

  });

}

function searchByName(button) {

  // Prendi la barra di ricerca
  const searchBar = document.getElementById("searchBar");

  // Se il testo della barra é troppo corto esci
  if (searchBar.value.length < 1) {

    window.alert("Inserisci il termine di ricerca");
    return;

  }

  // Prendi tutte le card
  const cards = Array.from(document.querySelectorAll(".columns > .card"));

  // Cambia il colore al tasto
  button.classList.toggle("is-danger");

  if (button.textContent.trim() === "Cerca") {

    // Effettua la ricerca
    const searchTerm = searchBar.value.toLowerCase().trim(); // Prendi il termine di ricerca

    cards.filter((card) => {

      return card
        .children[1]                // Seleziona la parte sotto la foto
        .children[0]                // Seleziona il paragrafo con il nome
        .textContent                // Seleziona il testo del nome
        .toLowerCase()              // Minuscolo
        .search(searchTerm) !== -1  // Confronta con il testo cercato

    }).forEach((card) => {

      card.style.display = 'block';

    });
    cards.filter((card) => {

      return card
        .children[1]               // Seleziona la parte sotto la foto
        .children[0]               // Seleziona il paragrafo con il nome
        .textContent               // Seleziona il testo del nome
        .toLowerCase()             // Minuscolo
        .search(searchTerm) === -1 // Confronta con il testo cercato

    }).forEach((card) => {

      card.style.display = 'none';

    });

    // Imposta la casella di ricerca su disabilitata
    searchBar.disabled = true;

    // Cambia il testo del pulsante
    button.textContent = "Mostra tutte";
  } else {
    // Reimposta i risultati

    // Mostra tutte le card
    cards.forEach((card) => { card.style.display = 'block'; });

    // Imposta la casella di ricerca su abilitata
    searchBar.disabled = false;

    // Resetta il contenuto della casella di ricerca
    searchBar.textContent = '';

    // Cambia il testo del pulsante
    button.textContent = "Cerca";

  }

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