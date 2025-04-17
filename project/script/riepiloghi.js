// PAGINA CARICATA
$(document).ready(async function()
{
    // prendo il riepilogo totale delle tratte del cliente
    let riepilogoTotale = await getRiepilogoTotaleCliente();

    // visualizzo il riepilogo totale delle tratte
    visualizzaRiepilogo(riepilogoTotale);

    // prendo tutte le tratte del cliente
    let tratte = await getTratte();

    // visualizzo le tratte tratte del cliente
    visualizzaTratte(tratte);
});

// PRENDO IL RIEPILOGO TOTALE DELLE TRATTE
async function getRiepilogoTotaleCliente()
{
    // chiamata al db
    let tratte = await richiestaJSON("../services/getRiepilogoTotaleCliente.php");

    return tratte;
}

// PRENDO LE TRATTE
async function getTratte()
{
    // chiamata al db
    let tratte = await richiestaJSON("../services/getTratteCliente.php");

    return tratte;
}

// VISUALIZZO LE TRATTE
async function visualizzaTratte(tratte)
{
    tratte.forEach(tratta => {
        visualizzaTratta(tratta);
    });
}

// FUNZIONE PER VISUALIZZARE IL RIEPILOGO TOTALE
async function visualizzaRiepilogo(riepilogoTotale)
{
    // inserisco dato nell'elemento
    $("#numeroTratteTotali").val(riepilogoTotale["numeroTratte"]);
    $("#chilometriTotali").val(riepilogoTotale["km_percorsi"]);
    $("#spesaTotale").val(riepilogoTotale["tariffa"]);
}

// FUNZIONE PER VISUALIZZARE UNA TRATTA
async function visualizzaTratta(tratta)
{
    // creo il div
    let div = $("<div class='mb-4'></div>");

    // elemento per il tipo
    let tipo = $("<input type='text' readonly='readonly' class='form-control'>").val(tratta["tipo"]);
    let div1 = $("<div class='col-sm-8'></div>");
    div1.append("tipo di operazione:");
    div1.append(tipo);
    div1.append("<br>");
    div.append(div1);

    // elemento per la data_ora
    let data_ora = $("<input type='text' readonly='readonly' class='form-control'>").val(tratta["data_ora"]);
    let div2 = $("<div class='col-sm-8'></div>");
    div2.append("data e ora operazione:");
    div2.append(data_ora);
    div2.append("<br>");
    div.append(div2);

    // se è una riconsegna
    if (tratta["tipo"] == "riconsegna") {
        // elemento per i km fatti
        let km_percorsi = $("<input type='text' readonly='readonly' class='form-control'>").val(tratta["km_percorsi"]);
        let div3 = $("<div class='col-sm-8'></div>");
        div3.append("km percorsi:");
        div3.append(km_percorsi);
        div3.append("<br>");

        // elemento per la tariffa
        let tariffa = $("<input type='text' readonly='readonly' class='form-control'>").val(tratta["tariffa"]);
        let div4 = $("<div class='col-sm-8'></div>");
        div4.append("tariffa:");
        div4.append(tariffa);
        div4.append("<br>");

        div.append(div3);
        div.append(div4);
    }

    // elemento per la stazione
    let stazione = $("<input type='text' readonly='readonly' class='form-control'>");
    // prendo via stazione
    let datiStazione = await richiestaJSON("../services/getStazioni.php", { stazione_id: tratta["stazione_id"] });
    stazione.val(datiStazione[0]["via"]);
    let div5 = $("<div class='col-sm-8'></div>");
    div5.append("presso stazione:");
    div5.append(stazione);
    div5.append("<br>");
    div.append(div5);

    $("#trattaPerTratta").append(div);
    $("#trattaPerTratta").append($("<br>"));
}
