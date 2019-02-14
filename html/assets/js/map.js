// Zibello
const centerLatitude = 45.021973;
const centerLongitude = 10.136450;

// Lista dei punti vendita
const places = [
  {
    "name": "Genova Fiumara",
    "position": [44.412704, 8.881479]
  },
  {
    "name": "Milano Fiera",
    "position": [45.468781, 9.182521]
  },
  {
    "name": "Torino Lingotto",
    "position": [45.037581, 7.628243]
  }
];

var map = null;

document.addEventListener("DOMContentLoaded", () => {

  "use strict";

  // Carica e mostra la mappa
  map = L.map('map').setView([centerLatitude, centerLongitude], 8);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Crea icona
  var myIcon = L.icon({
    iconUrl: 'assets/images/rubber-duck-icon.png',
    iconSize: [40, 40],
    iconAnchor: [20, 20],
    popupAnchor: [25, -15]
  });

  // Aggiungi ogni punto vendita alla mappa
  places.forEach(element => {
    L.marker(element.position, { icon: myIcon })
      .bindPopup(element.name)
      .openPopup()
      .addTo(map);
  });
});

function centerMap(element) {

  "use strict";

  // Ottieni il nome
  let name = element.textContent;

  // Trova l'oggetto place associato a quel nome
  let place = places.find((e) => { return e.name == name });

  // Sposta il centro della mappa
  map.panTo(place.position);

  // Zoom
  setTimeout(() => {
    map.setZoom(12, {
      animate: true
    });
  }, 750)
}