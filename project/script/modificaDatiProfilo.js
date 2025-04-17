// dati modificabili
let nome = "";
let cognome = "";
let mail = "";
let username = "";
let indirizzo = "";
let latitudine = "";
let longitudine = "";

// PAGINA CARICATA
$(document).ready(async function()
{
    // prendo i dati del cliente
    let dati = await getDati();

    // carico i dati del cliente
    await caricaDati(dati);
});

// MODIFICA DATI DEL PROFILO
async function modificaDati()
{
    indirizzo = $("#indirizzo").val();

    // prendo latitudine e longitudine dall'indirizzo
    getLatLonFromAddress(indirizzo)
    .then(async coordinate => {
        console.log("Lat: " + coordinate[0] + " -- Lon: " + coordinate[1]);
        latitudine = coordinate[0];
        longitudine = coordinate[1];

            // modifico i dati nel database
            let stato = await richiestaJSON("../services/modificaDatiProfilo.php", {nome: nome, cognome: cognome, mail: mail, username: username, indirizzo: indirizzo, latitudine: latitudine, longitudine:longitudine});

            if(stato == true)
            {
                alert("Dati modificati");
                window.location.href = "../pages/profilo.php";
            }
            else
                alert("Errore! Dati non modificati");

            })
    .catch(error => {
        console.error(error);
    });
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

// CARICO I DATI
async function caricaDati(dati)
{
    $("#nome").val(dati["nome"]);
    $("#cognome").val(dati["cognome"]);
    $("#mail").val(dati["mail"]);
    $("#username").val(dati["username"]);
    $("#indirizzo").val(dati["indirizzo"]);

    // prendo i dati attuali
    nome = $("#nome").val();
    cognome = $("#cognome").val();
    mail = $("#mail").val();
    username = $("#username").val();
    indirizzo = $("#indirizzo").val();
}

// PRENDO I DATI
async function getDati()
{
    // chiamata al db
    let result = await richiestaJSON("../services/getDatiCliente.php");

    return result;
}

// PRENDO LA MODIFICA DEL NOME
function modificaNome()
{
    nome = $("#nome").val();
}

// PRENDO LA MODIFICA DEL COGNOME
function modificaCognome()
{
    cognome = $("#cognome").val();
}

// PRENDO LA MODIFICA DELLA MAIL
function modificaMail()
{
    mail = $("#mail").val();
}

// PRENDO LA MODIFICA DELL'USERNAME
function modificaUsername()
{
    username = $("#username").val();
}