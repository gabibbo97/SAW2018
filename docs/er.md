# Schema database

## Entitá

- `Articolo` rappresenta un articolo del blog
- `Tag` rappresenta un tag assegnato a un articolo del blog
- `Utente` rappresenta un utente iscritto al sito

## Attributi

### Articolo

| Nome campo    | Proprietá                  | Descrizione                |
| ------------- | -------------------------- | -------------------------- |
| `id`          | chiave, numero progressivo | Identificatore             |
| `titolo`      | testo                      | Titolo dell'articolo       |
| `sottotitolo` | testo                      | Sottotitolo dell'articolo  |
| `data`        | data                       | Data di pubblicazione      |
| `corpo`       | testo                      | Il contenuto dell'articolo |

### Tag

| Nome campo    | Proprietá | Descrizione                  |
| ------------- | --------- | ---------------------------- |
| `nome`        | chiave    | Nome del tag                 |
| `descrizione` | testo     | Descrizione in breve del tag |

### Utente

| Nome campo         | Proprietá | Descrizione                                     |
| ------------------ | --------- | ----------------------------------------------- |
| `cognome`          | testo     | Cognome dell'utente                             |
| `email`            | testo     | Email dell'utente                               |
| `nome`             | testo     | Nome dell'utente                                |
| `password`         | testo     | Hash + salt della password                      |
| `percorsoImmagine` | opzionale | Dove si trova l'immagine del profilo sul server |
| `regione`          | opzionale | Regione di provenienza dell'utente              |
| `riceveNewsletter` | booleano  | Se l'utente desidera ricevere newsletter        |
| `tipoUtente`       | enum      | `ADMIN` / `USER`                                |
| `username`         | chiave    | Username dell'utente                            |

## Relazioni

- __Caratterizza__ _(Tag <-> Articolo)_ [N:M]: Collega un articolo con i suoi tag
- __Scrive__ _(Utente <-> Articolo)_ [1:N]: Collega un articolo con il suo autore

## Tabelle



## Dati di prova

```sql
-- Utenti
INSERT INTO `utente` (`username`, `nome`, `cognome`, `email`, `password`, `percorsoImmagine`, `riceveNewsletter`, `tipoUtente`, `regione`)
VALUES ('gabibbo97', 'Giacomo', 'Longo', `test@email.com`, 'testPass1', NULL, '0', 2, 8);
INSERT INTO `utente` (`username`, `nome`, `cognome`, `email`, `password`, `percorsoImmagine`, `riceveNewsletter`, `tipoUtente`, `regione`)
VALUES ('aladimpa', 'Roberta', 'Tassara', `test@email.com`, 'testPass2', NULL, '1', 1, 8);
INSERT INTO `utente` (`username`, `nome`, `cognome`, `email`, `password`, `percorsoImmagine`, `riceveNewsletter`, `tipoUtente`, `regione`)
VALUES ('VariabileAleatoria', 'Alessandro', 'Orlich', `test@email.com`, 'testPass3', NULL, '0', 2, 4);
-- Tags
INSERT INTO `tag` (`nome`, `descrizione`) VALUES ('papere', 'A me piacciono molto'), ('tag1', NULL), ('tag2', NULL);
-- Articles
INSERT INTO `articolo` (`id`, `titolo`, `sottotitolo`, `data`, `corpo`, `autore`) VALUES
(2,	'Articolo 1',	NULL,	'2019-02-10',	'Scacciarla sospettoso trascinato uno cambieremo ape incontrato era cancellato. Mio taciturna chiamasti dai intendeva. Ma oh visibile nascosta spremere pensieri. Sete nei aver ape ama ieri. Fai aria che sei onde mare rote pene. Ah ed sconvolto riconosco deliziosa. \r\n\r\nStarne fatica chi dunque san gonfio allora doveva. Sta tre riprodurre dir abbassando dal chinandosi seducevano. Ch il un vorrei il calice antico errore salire. Dai rovescio migliore tua arrivato plasmata ben era mutevole. Nell sai cure ora onda lui omai. Che forti tutta cui spero tua sue. Piu faceva spenta riparo bruchi ami. \r\n\r\nSole uomo mai puo essa pone onda ben. Del temo sue pie senz una vidi. Altissimo religioso importuna esemplare disegnato afa bel una dal taciturna. Sai cio ora oro soli dire rete pini usci. Ne struggeva ginocchia conquista me rapimento. Esce ambe sete dal mio ecco solo buoi. \r\n\r\nSemplice chi creatura ore divenuto san. Gia batta vai verra sento era getto vuole. Credete piu qualche entrare fresche tuo del. Ben abbiano milizie persone conosci vai lettera era rivedro. Osi poi statuette desiderio arrestare fanciullo splendori tal. La dominati ginocchi va ci lasciati gettando tamerici pranzate. \r\n',	'gabibbo97'),
(3,	'Articolo 2',	'Bottom text',	'2019-02-10',	'Tua ali perse mai certo molte andro. Bel limite pel una piombo felice. Orecchio io speranze fu incendio ha lacerato. Mi riflettere declinante vergognoso implorando ch. Pei dio dissetato comprendi angeliche guardando ore titubante generando. Me dune moto ozio bene senz dell la. Stelle ero chi che immune vostra. Morivi starne alzati una stacca velavi all membra sii. Tenue su lieve vivra scena umana da or fatta. \r\n\r\nVedi come fra hai tele mai sono fino udi. Da malato pensai saremo va scossa limiti vostri. Mi bruchi po studio ai febbre volevo stelle le. Mostra stelle da quindi ai tenuta. Ad gettare purezza ed augusta al mi spasimo sentire credete. Ricuperato convertira persuadere il ho so pericolosa trascinano al volgendosi. Rapimento il sconvolto al mi destinata. \r\n\r\nTalismani sorrideva com esistenza udi ore veramente dimagrato. Mio chi aspettera affannosa solitario oltremare conoscete suo mia. Vacillavo pie sollecito cio altissimi. Ritorna vissuto mie fra conosci mattini versate. Supplizio hai usignuoli sollevera accomiata suo. Oh stridore ha tremante lasciati spinetta ci le. Baciato intinti puo qualche chi ricordo afa lei. Supplico dominati puo divenuta sembrano piu ore che universo lasciami. \r\n\r\nOr fato pace ah reni. Gocciole com ape virtuoso minerale dal. Importuna altissimi settimane com palpitare torturare uno. Poi mai perfino amo entrare pensavo milizie modella destino. Vede ha mese lo veda aria. Irrequieto giudichera ad se sospettoso trascinava. \r\n',	'aladimpa'),
(5,	'Articolo 3',	NULL,	'2019-02-10',	'\r\nTalismani sorrideva com esistenza udi ore veramente dimagrato. Mio chi aspettera affannosa solitario oltremare conoscete suo mia. Vacillavo pie sollecito cio altissimi. Ritorna vissuto mie fra conosci mattini versate. Supplizio hai usignuoli sollevera accomiata suo. Oh stridore ha tremante lasciati spinetta ci le. Baciato intinti puo qualche chi ricordo afa lei. Supplico dominati puo divenuta sembrano piu ore che universo lasciami. \r\n',	'VariabileAleatoria');
-- Caratterizza
INSERT INTO `caratterizza` (`id_articolo`, `tag`) VALUES
(2,	'tag1'),
(2,	'tag2'),
(5,	'papere'),
(5,	'tag1'),
(5,	'tag2');
```