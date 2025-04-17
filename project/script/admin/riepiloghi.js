// PAGINA CARICATA
$(document).ready(async function()
{
    // prendo tutte le stazioni
    let stazioni = await getStazioni();

    // visualizzo stazioni
    visualizzaStazioni(stazioni);

    // prendo tutte le biciclette
    let biciclette = await getBiciclette();

    // visualizzo biciclette
    visualizzaBiciclette(biciclette);
});

// PRENDO LE BICICLETTE
async function getBiciclette()
{
    // chiamata al db
    let biciclette = await richiestaJSON("../../services/getBiciclette.php");

    return biciclette;
}

// PRENDO LE STAZIONI
async function getStazioni()
{
    // chiamata al db
    let stazioni = await richiestaJSON("../../services/getStazioni.php");

    return stazioni;
}

// VISUALIZZO LE STAZIONI
async function visualizzaStazioni(stazioni)
{
    stazioni.forEach(stazione => {
        visualizzaStazione(stazione);
    });
}

// FUNZIONE PER VISUALIZZARE UNA STAZIONE
async function visualizzaStazione(stazione)
{
    // creo il div
    let div = $("<div></div>")

    // elemento per la via della stazione
    let viaStazione = $("<input type='text' readonly='readonly'>")
    viaStazione.val(stazione["via"]);
    div.append("via stazione: ");
    div.append(viaStazione);

    // elemento per il link
    let url = "stazione.php?stazione_id="+stazione["stazione_id"];
    let link = $("<a href='"+url+"'>VISUALIZZA RIEPILOGO STAZIONE</a>")
    div.append(link);
    div.append("<br>");

    $("#riepilogoStazioni").append(div);
    $("#riepilogoStazioni").append($("<br>"));
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

    // elemento per il link
    let url = "bicicletta.php?bicicletta_id="+bicicletta["bicicletta_id"];
    let link = $("<a href='"+url+"'>VISUALIZZA RIEPILOGO BICICLETTA</a>")
    div.append(link);
    div.append("<br>");

    $("#riepilogoBiciclette").append(div);
    $("#riepilogoBiciclette").append($("<br>"));
}