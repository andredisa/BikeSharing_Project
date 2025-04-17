// PAGINA CARICATA
$(document).ready(async function()
{
    // prendo tutte le biciclette in manutenzione
    let biciclette = await getBicicletteInManutenzione();

    // visualizzo biciclette
    visualizzaBiciclette(biciclette);
});

// PRENDO LE BICICLETTE IN MANUTENZIONE
async function getBicicletteInManutenzione()
{
    // chiamata al db
    let biciclette = await richiestaJSON("../../services/getBicicletteInManutenzione.php");

    return biciclette;
}

// VISUALIZZO LE BICICLETTE
async function visualizzaBiciclette(biciclette)
{
    biciclette.forEach(bicicletta => {
        visualizzaBicicletta(bicicletta);
    });
}

// FUNZIONE PER VISUALIZZARE UNA BICICLETTA
async function visualizzaBicicletta(bicicletta)
{
    // creo il div
    let div = $("<div></div>")

    // elemento per il codice della bicicletta
    let codiceBicicletta = $("<input type='text' readonly='readonly'>")
    codiceBicicletta.val(bicicletta["codice"]);
    div.append("codice bicicletta: ");
    div.append(codiceBicicletta);

    // elemento per i km percorsi
    let km_percorsi = $("<input type='text' readonly='readonly'>")
    km_percorsi.val(bicicletta["km_percorsi"]);
    div.append("km percorsi: ");
    div.append(km_percorsi);

    // elemento per il link
    let link = $("<a href='fineManutenzione.php?bicicletta_id="+bicicletta["bicicletta_id"]+"'>FINE MANUTENZIONE</a>")
    div.append(link);

    $("#biciclette").append(div);
    $("#biciclette").append($("<br>"));
}