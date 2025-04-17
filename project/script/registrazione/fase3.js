let nome = null;
let cognome = null;
let username = null;
let mail = null;
let password = null;

// DOCUMENTO CARICATO
$(document).ready(function()
{
    // controllo i dati della fase precedente
    getDatiFasePrecedente();

    // fase 2 non fatta
    if(username == null || username == null || password == null)
        // reindirizzamento
        window.location.href = "fase2.php";
    else
        // inserisco i dati  nella pagina
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
}

// FUNZIONE PER INSERIRE I DATI DELLA FASE PRECEDENTE NELLA PAGINA
function visualizzaDati()
{
    $("#nome").text("nome: " + nome);
    $("#cognome").text("cognome: " + cognome);
    $("#username").text("username: " + username);
    $("#mail").text("mail: " + mail);
}

let indirizzo = null;
let latitudine = null;
let longitudine = null;

// PROCEDO CON LA REGISTRAZIONE
async function avanti()
{
    // prendo i parametri
    indirizzo = $("#indirizzo").val();

    // eseguo i controlli
    let stato = doControlli();

    if(stato == true)
    {
        getLatLonFromAddress(indirizzo)
        .then(coordinate => {
            console.log("Lat: " + coordinate[0] + " -- Lon: " + coordinate[1]);
            latitudine = coordinate[0];
            longitudine = coordinate[1];
            salvaDati(indirizzo, latitudine, longitudine);
        })
        .catch(error => {
            console.error(error);
        });
    }

    reindizzamento(stato);
}

// FUNZIONE PER PRENDERE LATITUDINE E LONGITUDINE DALL'INDIRIZZO INSERIT
function getLatLonFromAddress(indirizzo) {
    let api_key = '3364281cf8284978864b8b201baeccdb';
    let query = indirizzo;
    let api_url = 'https://api.opencagedata.com/geocode/v1/json';

    let request_url = api_url
        + '?'
        + 'key=' + api_key
        + '&q=' + encodeURIComponent(query)
        + '&pretty=1'
        + '&no_annotations=1';

    return new Promise((resolve, reject) => {
        let request = new XMLHttpRequest();
        request.open('GET', request_url, true);

        request.onload = function () {
            if (request.status === 200) {
                let data = JSON.parse(request.responseText);
                resolve([data.results[0].geometry.lat, data.results[0].geometry.lng]);
            } else if (request.status <= 500) {
                let data = JSON.parse(request.responseText);
                reject("Unable to geocode! Response code: " + request.status + ", error msg: " + data.status.message);
            } else {
                reject("Server error");
            }
        };

        request.onerror = function () {
            reject("Unable to connect to server");
        };

        request.send();
    });
}

// RICHIESTA SERVIZIO
function richiesta(page, params)
{
    return new Promise(function(resolve)
    {
        $.get(page, params, function(phpData)
        {
            resolve(phpData);
        });
    });
}

// CONTROLLI SUI PARAMETRI IN INPUT
function doControlli()
{
    // parametri mancanti
    if(indirizzo == "")
        return "ERRORE! Inserire l'indirizzo!";

    // tutto ok
    return true;
}

// REINDIRIZZAMENTO
function reindizzamento(stato)
{
    // controlli ok
    if(stato == true)
    {        
        // reindirizzo
        window.location.href = "fase4.php";
    }
    else
        alert(stato);
}

// FUNZIONE PER SALVARE I DATI DELLA FASE
function salvaDati(indirizzo, latitudine, longitudine)
{
    localStorage.setItem('indirizzo', indirizzo);
    localStorage.setItem('latitudine', latitudine);
    localStorage.setItem('longitudine', longitudine);
}