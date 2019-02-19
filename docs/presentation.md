# Presentazione di "Le mille piú uno paperelle"

Il sito si occupa della promozione di una catena di negozi specializzati nella vendita di paperelle di gomma dislocati nel nord Italia.

Non si occupa della vendita dei prodotti stessi, avendo solo finalitá promozionali e di "catalogo" online.

## Immagine della homepage



## Funzionalitá implementate

### Obbligatorie

#### Presentazione

La homepage fornisce una breve descrizione dei prodotti offerti e delle caratteristiche peculiari che li caratterizzano.

Ogni pagina presenta nel footer una lista di contatti dove poter contattare l'azienda.

Alla prima visualizzazione del sito, l'utente viene inviato a una pagina che introduce "Le mille piú uno paperelle" come ipotetico leader commerciale nel settore in cui opera.

Nella pagina "Chi siamo", é presente una mappa dei punti vendita in cui il click su un negozio effettua lo spostamento della mappa nelle sue vicinanze.

#### Registrazione utenti

Se l'utente non é autenticato, ogni pagina presenta una barra con il pulsante "Registrati" che se premuto invia l'utente a una pagina dedicata.

L'utente viene identificato dal suo username.

I dati obbligatori richiesti sono `nome, cognome, username, email` e `password`, é richiesta anche l'accettazione di dei termini di servizio fittizi.

Opzionalmente si puó fornire il consenso ad essere inclusi nella newsletter e una regione di provenienza.

#### Login

Se l'utente non é autenticato, ogni pagina presenta una barra con il pulsante "Accedi" che se premuto fa comparire un elemento extra sotto alla barra di navigazione, questo elemento funge da form di login attraverso l'inserimento della coppia `username`, `password`.

É presente un pulsante per visualizzare la password in chiaro.

A login effettuato si viene indirizzati alla pagina di gestione utente.

Tutte le aree richiedenti un login non sono accessibili al pubblico.

#### Modifica del profilo

Nell'area di gestione utente, é possibile modificare il proprio indirizzo email, la propria regione, la password, le preferenze inerenti alla newsletter e cancellare definitivamente il proprio account ed ogni dato ad esso associato.

É possibile anche caricare una immagine del profilo che sará visualizzata in ogni pagina.

#### Motore di ricerca interno

##### Client-side

Nella pagina dei prodotti é possibile filtrare i diversi prodotti per nome, prezzo o categoria.

Questa ricerca é realizzata interamente in JavaScript e non richiede il ricaricamento della pagina.

##### Server-side

Nel blog é possibile esplorare i diversi tag e di ricercare all'interno del testo degli articoli.

La ricerca é realizzata mediante la ricerca per indici `FULLTEXT` per versioni di MySQL > 5.6 e mediante una ricerca per wildcard per versioni inferiori.

### Opzionali

#### Blog

Gli utenti amministratori possono pubblicare post sul blog mediante un pannello di amministrazione.

Ogni post ha un titolo, sottotitolo (opzionale), un corpo e una serie di tag associati.

Dal pannello di gestione é possibile impostare la descrizione dei tag che verrá visualizzata qualora un utente prema sul rispettivo pulsante dell'interfaccia di ricerca.

#### Newsletter

Gli utenti amministratori possono spedire un messaggio a tutti gli utenti che hanno indicato nelle preferenze di voler ricevere la newsletter.

É possibile personalizzare il messaggio inviato mediante alcuni marcatori appositi che sono indicati nell'interfaccia.

Ogni email inviata risulta essere inviata a un singolo destinatario, evitando di esporre le email agli altri utenti.

## Soluzioni tecniche

- HTML5 per le pagine web
- JavaScript per gli elementi interattivi
- PHP per il backend
- SQL per l'accesso ai dati, mediante il PDO
- CSS per lo stile, (é stato utilizzato il framework Bulma)

Sono stati usati i prepared statement per proteggere il sito da SQL injection.

Ogni controllo client side é considerato esclusivamente "assistenza" per l'utente e ha una controparte server-side.

É stato usato AJAX per alcuni controlli client-side.
