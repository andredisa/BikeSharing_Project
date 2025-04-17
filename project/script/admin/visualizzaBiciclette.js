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

    // prendo tutte le biciclette
    let biciclette = await getBiciclette();

    // aggiungo i marker delle biciclette alla mappa
    aggiungiBiciclette(biciclette);
}

// FUNZIONE PER PRENDERE LE BICICLETTE
async function getBiciclette()
{
    let biciclette = await richiestaJSON("../../services/getBiciclette.php");

    return biciclette;
}

// FUNZIONE PER AGGIUNGERE LE BICICLETTE NELLA MAPPA
function aggiungiBiciclette(biciclette)
{
    // per ogni bicicletta
    biciclette.forEach(bicicletta => {
        // aggiungo il marker nella mappa
        aggiungiBicicletta(bicicletta);
    });
}

// Crea un'icona personalizzata usando un'immagine JPG
let biciclettaIcon = L.icon({
    iconUrl: '../../file/img/bicicletta.jpg', // Specifica il percorso della tua immagine
    iconSize: [40, 40], // Dimensione dell'icona
    iconAnchor: [16, 32], // Punto dell'icona che corrisponde alla posizione del marker
    popupAnchor: [0, -32] // Punto dell'icona da cui si apre il popup
});

// FUNZIONE PER AGGIUNGERE IL MARKER DI UNA BICICLETTA NELLA MAPPA
async function aggiungiBicicletta(bicicletta)
{
    // marker
    let marker = L.marker([bicicletta["latitudine"], bicicletta["longitudine"]], { icon: biciclettaIcon} ).addTo(mappa);

    // popup
    let popupContent = `
        <a href="../../pages/admin/bicicletta.php?bicicletta_id=`+bicicletta["bicicletta_id"]+`">Visualizza bicicletta</a><br>
        <a href="../../pages/admin/modificaBicicletta.php?bicicletta_id=`+bicicletta["bicicletta_id"]+`">Modifica bicicletta</a><br>
        <a href="../../pages/admin/eliminaBicicletta.php?bicicletta_id=`+bicicletta["bicicletta_id"]+`">Elimina bicicletta</a>
    `;

    // Aggiungi il popup al marker
    marker.bindPopup(popupContent);

    // alla selezione del marker
    marker.on('click', function(e) {
        // Mostra il popup
        marker.openPopup();
    });
}