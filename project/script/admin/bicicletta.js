// PAGINA CARICATA
$(document).ready(async function()
{
    // prendo la bicicletta
    let bicicletta = await getBicicletta();

    // visualizzo bicicletta
    visualizzaBicicletta(bicicletta);
});

// PRENDO LA BICICLETTA
async function getBicicletta()
{
    // chiamata al db
    let bicicletta = await richiestaJSON("../../services/getBiciclette.php");

    return bicicletta[0];
}

// VISUALIZZO BICICLETTA
async function visualizzaBicicletta(bicicletta)
{
    // creo il div
    let div = $("<div></div>")

    // elemento per il codice della bicicletta
    let codice = $("<input type='text' readonly='readonly'>")
    codice.val(bicicletta["codice"]);
    div.append("codice bicicletta: ");
    div.append(codice);
    div.append("<br>");

    // elemento per i km totali percorsi
    let kmTotaliPercorsi = $("<input type='text' readonly='readonly'>")
    kmTotaliPercorsi.val(bicicletta["km_percorsi"]);
    div.append("km totali percorsi: ");
    div.append(kmTotaliPercorsi);
    div.append("<br>");

    // elemento per il numero di operazione
    let numOperazioni = $("<input type='text' readonly='readonly'>")
    let operazioni = await getOperazioniBicicletta();
    numOperazioni.val(operazioni.length);
    div.append("numero operazioni bicicletta: ");
    div.append(numOperazioni);
    div.append("<br>");

    $("#riepilogoBicicletta").append(div);

    // visualizzo le operazioni
    visualizzaOperazioni(operazioni);
}

// FUNZIONE PER VISUALIZZARE LE OPERAZIONI
function visualizzaOperazioni(operazioni)
{
    operazioni.forEach(operazione => {
        visualizzaOperazione(operazione);
    });
}

// VISUALIZZO L'OPERAZIONE
function visualizzaOperazione(operazione)
{
    // creo il div
    let div = $("<div></div>")

    // elemento per il tipo
    let tipo = $("<input type='text' readonly='readonly'>")
    tipo.val(operazione["tipo"]);
    div.append("tipo operazione: ");
    div.append(tipo);
    div.append("<br>");

    // elemento per data_ora
    let data_ora = $("<input type='text' readonly='readonly'>")
    data_ora.val(operazione["data_ora"]);
    div.append("data e ora operazione: ");
    div.append(data_ora);
    div.append("<br>");

    // se è una riconsegna
    if(operazione["tipo"] == "riconsegna")
    {
        // elemento per i km percorsi
        let kmPercorsi = $("<input type='text' readonly='readonly'>")
        kmPercorsi.val(operazione["km_percorsi"]);
        div.append("km percorsi: ");
        div.append(kmPercorsi);
    }

    $("#riepilogoOperazioni").append(div);
    $("#riepilogoOperazioni").append("<br>");

}

// FUNZIONE PER PRENDERE IL NUMERO DI OPERAZIONI FATTE SU UNA STAZIONE
async function getOperazioniBicicletta()
{
    // chiamata al db
    let op = await richiestaJSON("../../services/getOperazioniBicicletta.php");

    return op;
}