// PAGINA CARICATA
$(document).ready(async function()
{
    // prendo la stazione
    let stazione = await getStazione();

    // visualizzo stazione
    visualizzaStazione(stazione);
});

// dati modificabili
let via = "";
let slotMax = "";

// PRENDO LA STAZIONE
async function getStazione()
{
    // chiamata al db
    let stazione = await richiestaJSON("../../services/getStazioni.php");

    return stazione[0];
}

// VISUALIZZO STAZIONE
async function visualizzaStazione(stazione)
{
    $("#via").val(stazione["via"]);
    $("#slotMax").val(stazione["slotMax"]);
}

// MODIFICA DATI DELLA STAZIONE
async function modificaStazione()
{
    via = $("#via").val();
    slotMax = $("#slotMax").val();

    // prendo latitudine e longitudine dall'indirizzo
    getLatLonFromAddress(via)
    .then(async coordinate => {
        console.log("Lat: " + coordinate[0] + " -- Lon: " + coordinate[1]);
        let latitudine = coordinate[0];
        let longitudine = coordinate[1];

            // modifico i dati nel database
            let stato = await richiestaJSON("../../services/modificaStazione.php", {via:via, latitudine: latitudine, longitudine: longitudine, slotMax:slotMax});

            if(stato == true)
            {
                alert("Stazione modificata");
                window.location.href = "../../pages/admin/visualizzaStazioni.php";
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