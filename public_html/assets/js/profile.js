function closeDeleteModal() {

    "use strict";

    // Prendi il modale
    const modal = document.getElementById("deleteModal");

    // Imposta is-active
    modal.classList.toggle("is-active");

}

function openDeleteModal() {

    "use strict";

    // Prendi il modale
    const modal = document.getElementById("deleteModal");

    // Imposta is-active
    modal.classList.toggle("is-active");

}

function showOldPassword(button) {

    showPassword(button, "oldPassword");

}

function menu(button, section) {

    // Prendi tutti i pulsanti delle tab
    const tabs = Array.from(document.querySelectorAll("main > .section > .tabs > ul > li"));

    // Aggiungi isActive al selezionato
    tabs.filter((tab) => {
        return tab.children[0] === button;
    }).forEach((e) => {
        e.classList.add("is-active");
    });

    // Rimuovi isActive da tutti gli altri
    tabs.filter((tab) => {
        return tab.children[0] !== button;
    }).forEach((e) => {
        e.classList.remove("is-active");
    });

    // Prendi tutti i div
    const divs = Array.from(document.querySelectorAll("main > div"));

    // Elimina tutti i div
    divs.slice(1).filter((div) => {
        return div.id !== section;
    }).forEach((div) => {
        div.style.display = "none";
    });

    // Mostra il div scelto
    divs.slice(1).filter((div) => {
        return div.id === section;
    }).forEach((div) => {
        div.style.display = "block";
    });
}
