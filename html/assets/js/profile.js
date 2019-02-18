function closeDeleteModal () {

  "use strict";

  // Prendi il modale
  const modal = document.getElementById("deleteModal");

  // Imposta is-active
  modal.classList.toggle("is-active");

}

function openDeleteModal () {

  "use strict";

  // Prendi il modale
  const modal = document.getElementById("deleteModal");

  // Imposta is-active
  modal.classList.toggle("is-active");

}

function showOldPassword (button) {

  "use strict";

  showPassword(button, "oldPassword");

}

function menu (button, section) {

  "use strict";

  // Prendi tutti i pulsanti delle tab
  const tabs = Array.from(document.querySelectorAll("main > .section > .tabs > ul > li"));

  // Aggiungi isActive al selezionato
  tabs.filter((tab) => tab.children[0] === button).forEach((e) => {

    e.classList.add("is-active");

  });

  // Rimuovi isActive da tutti gli altri
  tabs.filter((tab) => tab.children[0] !== button).forEach((e) => {

    e.classList.remove("is-active");

  });

  // Prendi tutti i div
  const divs = Array.from(document.querySelectorAll("main > div"));

  // Elimina tutti i div
  divs.slice(1).filter((div) => div.id !== section)
    .forEach((div) => {

      div.style.display = "none";

    });

  // Mostra il div scelto
  divs.slice(1).filter((div) => div.id === section)
    .forEach((div) => {

      div.style.display = "block";

    });

}

function updateTags () {

  "use strict";

  // Prendi il campo nascosto per passare i dati
  const tagsHiddenField = document.getElementById('tagsHiddenField');

  // Struttura dati per salvare i tag selezionati
  let tags = {
    "existing_tags" : [],
    "new_tags" : []
  };

  // Prendi i tag esistenti selezionati
  tags['existing_tags'] = 
    Array.from(document.getElementById("existingTags").children) // Prendi tutti i figli del div contenente i tag
      .map((e) => e.children[0])                                 // Trasforma ogni elemento nel suo primo figlio
      .filter((e) => e.children[1].children[0].checked)          // Seleziona solo gli elementi in la checkbox é premuta
      .map((e) => e.children[0].textContent);                    // Prendi il contenuto
  
  // Prendi i tag esistenti selezionati
  tags['new_tags'] = 
    Array.from(document.getElementById("addedTags").children) // Prendi tutti i figli del div contenente i tag
      .map((e) => e.children[0])                              // Trasforma ogni elemento nel suo primo figlio
      .filter((e) => e.children[1].children[0].checked)       // Seleziona solo gli elementi in la checkbox é premuta
      .map((e) => e.children[0].textContent);                 // Prendi il contenuto

  // Assegna all'input hidden la rappresentazione come stringa della struttura dati
  tagsHiddenField.value = JSON.stringify(tags);

}

function addNewTag () {

  function createNewTagElement (tagName) {

    "use strict";

    /*
      <div class="control">                               <-- DIV 1
        <div class="tags has-addons">                     <-- DIV 2
          <div class="tag">Nome tag</div>                 <-- DIV 3
          <div class="tag"><input type="checkbox"></div>  <-- DIV 4
        </div>
      </div>
    */
    // DIV 1
    const div1 = document.createElement('div');
    div1.classList.add('control');
    // DIV 2
    const div2 = document.createElement('div');
    div2.classList.add('tags');
    div2.classList.add('has-addons');
    // DIV 3
    const div3 = document.createElement('div');
    div3.classList.add('tag');
    div3.textContent = tagName.trim().toLowerCase();
    // DIV 4
    const div4 = document.createElement('div');
    div4.classList.add('tag');
    // DIV 4 -> Checkbox
    const div4checkbox = document.createElement('input');
    div4checkbox.type = 'checkbox';
    div4checkbox.checked = true;
    div4checkbox.onclick = updateTags;

    // Unione di tutti i componenti
    div4.appendChild(div4checkbox);

    div2.appendChild(div3);
    div2.appendChild(div4);

    div1.appendChild(div2);

    return div1;
  }

  "use strict";

  const newTagField = document.getElementById("newTagField");
  const newTagInput = newTagField.children[0].children[0];

  // Ignora i tag vuoti
  if (newTagInput.value.trim().length < 1)
    return;
  
  // Aggiungi un nuovo elemento tag
  const addedTagsDiv = document.getElementById("addedTags");
  const addedTagElement = createNewTagElement(newTagInput.value);
  addedTagsDiv.appendChild(addedTagElement);
  newTagInput.value = '';
  updateTags();
}
