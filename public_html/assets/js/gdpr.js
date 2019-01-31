document.addEventListener("DOMContentLoaded", function() {
  function displayGDPR() {
    // Genera l'elemento che oscura la pagina
    let sfondo = document.createElement("aside");
    sfondo.id = "GDPR";
    // Genera il form GDPR
    let form = document.createElement("form");
    let formElement1 = document.createElement("span");
    formElement1.textContent = "Nonostante i biscotti non siano indicati per l'alimentazione delle papere, lei, in quanto umano, é tenuto ad acconsentire a ricevere nel suo navigatore dei freschissimi cookie";
    let formElement2 = document.createElement("button");
    formElement2.textContent = "Gnam cookies";
    let formElement3 = document.createElement("href");
    formElement3.textContent = "La ricetta dei nostri cookies";
    formElement3.href = "https://ricette.giallozafferano.it/Cookies.html";
    // Aggiungi i figli al form
    form.appendChild(formElement1);
    form.appendChild(formElement2);
    form.appendChild(formElement3);
    // Aggiungi il form allo sfondo
    sfondo.appendChild(form);
    // Aggiungi lo sfondo alla pagina
    document.body.appendChild(sfondo);
    // Visualizza l'elemento
    const gdpr = document.getElementById("GDPR");
    gdpr.style.display = 'flex';
    gdpr.children[0].children[1].onclick = function() {
      let now = new Date();
      document.cookie = "gdprconsent=" + encodeURIComponent(now.toString()) + ";max-age=31536000";
    }
  }


  if (! document.cookie.includes("gdprconsent")) {
    // Genera il link al CSS per il form
    let cssLink = document.createElement("link");
    cssLink.type = "text/css";
    cssLink.rel = "stylesheet";
    cssLink.href = "assets/css/gdpr.css";
    cssLink.onload = function() {
      displayGDPR()
    }
    document.getElementsByTagName("head")[0].appendChild(cssLink);
  }
});