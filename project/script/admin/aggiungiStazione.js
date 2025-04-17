let via = "";
let slotMax = "";

// AGGIUNGO LA STAZIONE
async function aggiungiStazione()
{
    via = $("#via").val();
    slotMax = $("#slotMax").val();

    let stato = doControlli();

    if(stato != true)
    {
        alert(stato);
        return;
    }

    // prendo latitudine e longitudine dall'indirizzo
    getLatLonFromAddress(via)
    .then(async coordinate => {
        console.log("Lat: " + coordinate[0] + " -- Lon: " + coordinate[1]);
        let latitudine = coordinate[0];
        let longitudine = coordinate[1];

            // aggiungo stazione
            let stato = await richiesta("../../services/aggiungiStazione.php", {via:via, latitudine: latitudine, longitudine: longitudine, slotMax:slotMax});

            if(stato = "")
            {
                alert("Stazione aggiunta");
                window.location.href = "../../pages/admin/visualizzaStazioni.php";
            }
            else
                alert("Errore! Stazione non aggiunta");

            })
    .catch(error => {
        console.error(error);
    });
}

// CONTROLLI SUI PARAMETRI IN INPUT
function doControlli()
{
    // parametri mancanti
    if(via == "" || slotMax == "")
        return "ERRORE! Inserire tutti i campi!";

    // tutto ok
    return true;
}

// FUNZIONE PER PRENDERE LATITUDINE E LONGITUDINE DALL'INDIRIZZO
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