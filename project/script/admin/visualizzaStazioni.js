// DOCUMENTO PRONTO
$(document).ready(function()
{
    // inserisco la mappa
    generaMappa();
});

// mappa
let mappa = null;

// FUNZIONE PER GENERARE LA MAPPA
async function generaMappa()
{
    // posizione iniziale della mappa
    let posIniziale = [45.468242296531756, 9.180818901720453]; // MILANO

    // creo una nuova istanza di mappa Leaflet
    mappa = L.map('map-container').setView(posIniziale, 12); // 10 è il livello di zoom iniziale

    // aggiungo un layer di mappa
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Mappa fornita da <a href="https://www.openstreetmap.org/">OpenStreetMap</a>'
    }).addTo(mappa);

    // prendo tutti le stazioni
    let stazioni = await getStazioni();

    // aggiungo i marker delle stazioni alla mappa
    aggiungiStazioni(stazioni);
}

// FUNZIONE PER PRENDERE LE STAZIONI
async function getStazioni()
{
    let stazioni = await richiestaJSON("../../services/getStazioni.php");

    return stazioni;
}

// FUNZIONE PER PRENDERE I POSTI LIBERI DI UNA STAZIONE
async function getPostiLiberi(params)
{
    let casaCliente = await richiestaJSON("../../services/getPostiLiberi.php", params);

    return casaCliente;
}

// FUNZIONE PER AGGIUNGERE LE STAZIONI NELLA MAPPA
function aggiungiStazioni(stazioni)
{
    // per ogni stazione
    stazioni.forEach(stazione => {
        // aggiungo il marker nella mappa
        aggiungiStaziOne(stazione);
    });
}

// Crea un'icona personalizzata usando un'immagine JPG
let stazioneIcon = L.icon({
    iconUrl: '../../file/img/stazione.jpg', // Specifica il percorso della tua immagine
    iconSize: [40, 40], // Dimensione dell'icona
    iconAnchor: [16, 32], // Punto dell'icona che corrisponde alla posizione del marker
    popupAnchor: [0, -32] // Punto dell'icona da cui si apre il popup
});

// FUNZIONE PER AGGIUNGERE IL MARKER DI UNA STAZIONE NELLA MAPPA
async function aggiungiStaziOne(stazione)
{
    // marker
    let marker = L.marker([stazione["latitudine"], stazione["longitudine"]], { icon: stazioneIcon} ).addTo(mappa);

    // prendo i posti liberi
    let postiLiberi = await getPostiLiberi({stazione_id: stazione["stazione_id"]});

    // popup
    let popupContent = `
        <b>Stazione ${stazione["via"]}</b><br>
        Posti liberi: ${postiLiberi}<br>
        <a href="../../pages/admin/stazione.php?stazione_id=`+stazione["stazione_id"]+`">Visualizza stazione</a><br>
        <a href="../../pages/admin/modificaStazione.php?stazione_id=`+stazione["stazione_id"]+`">Modifica stazione</a><br>
        <a href="../../pages/admin/eliminaStazione.php?stazione_id=`+stazione["stazione_id"]+`">Elimina stazione</a>
    `;

    // Aggiungi il popup al marker
    marker.bindPopup(popupContent);

    // alla selezione del marker
    marker.on('click', function(e) {
        // Mostra il popup
        marker.openPopup();
    });
}