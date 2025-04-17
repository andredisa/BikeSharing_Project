let nome = null;
let cognome = null;
let username = null;
let mail = null;
let password = null;
let indirizzo = null;
let latitudine = null;
let longitudine = null;

// DOCUMENTO CARICATO
$(document).ready(function()
{
    // controllo i dati della fase precedente
    getDatiFasePrecedente();

    // fase 3 non fatta
    if(indirizzo == null)
        // reindirizzamento alla fase 3
        window.location.href = "fase3.php";
    else
        // inserisco i dati nella pagina
        visualizzaDati();
});

// FUNZIONE PER PRENDERE I DATI DELLA FASE PRECEDENTE
function getDatiFasePrecedente()
{
    nome = localStorage.getItem('nome');
    cognome = localStorage.getItem('cognome');
    username = localStorage.getItem('username');
    mail = localStorage.getItem('mail');
    password = localStorage.getItem('password');
    indirizzo = localStorage.getItem('indirizzo');
    latitudine = localStorage.getItem('latitudine');
    longitudine = localStorage.getItem('longitudine');
}

// FUNZIONE PER INSERIRE I DATI DELLA FASE PRECEDENTE NELLA PAGINA
function visualizzaDati()
{
    $("#nome").text("nome: " + nome);
    $("#cognome").text("cognome: " + cognome);
    $("#username").text("username: " + username);
    $("#mail").text("mail: " + mail);
    $("#indirizzo").text("indirizzo: " + indirizzo);
}

let nomeTitolareCarta = null;
let cognomeTitolareCarta = null;
let numeroCarta = null;
let scadenzaCarta = null;
let cvvCarta = null;

// REGISTRAZIONE
async function doRegistrazione()
{
    // prendo i parametri
    nomeTitolareCarta = $("#nomeTitolareCarta").val();
    cognomeTitolareCarta = $("#cognomeTitolareCarta").val();
    numeroCarta = $("#numeroCarta").val();
    scadenzaCarta = $("#scadenzaCarta").val();
    cvvCarta = $("#cvvCarta").val();

    // eseguo i controlli
    let stato = doControlli();

    // controlli a buon fine
    if(stato == true)
    {
        // richiestra di registrazione al db
        await callDB_registrazione();
    }
    else
    {
        alert(stato);
        return;
    }
}

// CONTROLLI SUI PARAMETRI IN INPUT
function doControlli()
{
    // parametri mancanti
    if(nomeTitolareCarta == "" || cognomeTitolareCarta == "" || numeroCarta == "" || scadenzaCarta == "" || cvvCarta == "")
        return "ERRORE! Inserire i dati richiesti!";

   // controllo numero della carta (lunghezza e che sono solo numeri)
    if(numeroCarta.length != 16 || /^\d{16}$/.test(numeroCarta) == false)
        return "ERRORE! Numero carta non valido!";

    // controllo scadenza carta
    if(!controlloData(scadenzaCarta))
        return "ERRORE! Scadenza carta non valida!";

    // controllo ccv della carta (lunghezza e che sono solo numeri)
    if(cvvCarta.length != 3 || /^\d{3}$/.test(cvvCarta) == false)
        return "ERRORE! Cvv carta non valido!";

    // tutto ok
    return true;
}

// FUNZIONE PER CONTROLLARE LA DATA
function controlloData(scadenzaCarta)
{
    // prendo mese e anno attuale
    let dataAttuale = new Date();
    let meseAttuale = dataAttuale.getMonth() + 1; // Mesi in JavaScript vanno da 0 a 11
    let annoAttuale = dataAttuale.getFullYear();

    // data non valida
    let [annoScadenza, meseScadenza] = scadenzaCarta.split('-').map(Number);
    if (annoScadenza < annoAttuale || (annoScadenza === annoAttuale && meseScadenza < meseAttuale))
        return false;

    return true;
}

// CHIAMATA AL DB PER FARE LA REGISTRAZIONE
async function callDB_registrazione()
{
    // chiamata al db
    let result = await richiesta("../../services/registrazione.php", {nome: nome, cognome:cognome, username: username, mail:mail, password:password, indirizzo:indirizzo, latitudine:latitudine, longitudine:longitudine, nomeTitolareCarta: nomeTitolareCarta, cognomeTitolareCarta: cognomeTitolareCarta, numeroCarta:numeroCarta, scadenzaCarta:scadenzaCarta, cvvCarta:cvvCarta});

    if(result == "")
        result = true;

    // reindirizzo
    reindizzamento(result)
}

// REINDIRIZZAMENTO
function reindizzamento(stato)
{
    // registrazione ok
    if(stato == true)
    {
        // svuoto local storage
        window.localStorage.clear();

        // reindirizzo
        window.location.href = "../mappa.php";
    }
    else
        alert(stato);
}