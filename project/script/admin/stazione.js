// PAGINA CARICATA
$(document).ready(async function()
{
    // prendo la stazione
    let stazione = await getStazione();

    // visualizzo stazione
    visualizzaStazione(stazione);
});

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
    // creo il div
    let div = $("<div></div>")

    // elemento per la via della stazione
    let viaStazione = $("<input type='text' readonly='readonly'>")
    viaStazione.val(stazione["via"]);
    div.append("via stazione: ");
    div.append(viaStazione);
    div.append("<br>");

    // elemento per gli slot massimi
    let slotMax = $("<input type='text' readonly='readonly'>")
    slotMax.val(stazione["slotMax"]);
    div.append("slot massimi stazione: ");
    div.append(slotMax);
    div.append("<br>");

    // elemento per il numero di operazione
    let numOperazioni = $("<input type='text' readonly='readonly'>")
    let operazioni = await getOperazioniStazione();
    numOperazioni.val(operazioni.length);
    div.append("numero operazioni stazione: ");
    div.append(numOperazioni);
    div.append("<br>");

    // elemento per gli slot disponibili
    let slotDisp = $("<input type='text' readonly='readonly'>")
    let slotDisponibili = await getSlotDisponibiliStazione();
    slotDisp.val(slotDisponibili);
    div.append("slot disponibili stazione: ");
    div.append(slotDisp);

    $("#riepilogoStazione").append(div);

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

    $("#riepilogoOperazioni").append(div);
    $("#riepilogoOperazioni").append("<br>");

}

// FUNZIONE PER PRENDERE IL NUMERO DI OPERAZIONI FATTE SU UNA STAZIONE
async function getOperazioniStazione()
{
    // chiamata al db
    let op = await richiestaJSON("../../services/getOperazioniStazione.php");

    return op;
}

// FUNZIONE PER PRENDERE IL NUMERO DI SLOT DISPONIBILI IN UNA STAZIONE
async function getSlotDisponibiliStazione()
{
    // chiamata al db
    let slotDisp = await richiestaJSON("../../services/getPostiLiberi.php");

    return slotDisp;
}