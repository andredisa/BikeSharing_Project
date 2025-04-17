// DOCUMENTO PRONTO
$(document).ready(async function()
{
    // prendo le stazioni
    let stazioni = await getStazioni();

    // inserisco le stazioni nella select
    insersciStazioni(stazioni);
});

// FUNZIONE PER PRENDERE LE STAZIONI
async function getStazioni()
{
    let stazioni = await richiestaJSON("../../services/getStazioni.php");

    return stazioni;
}

// FUNZIONE PER INSERIRE LE STAZIONI NELLA SELECT
function insersciStazioni(stazioni)
{
    stazioni.forEach(stazione => {
        insersciStazione(stazione);
    });
}

// FUNZIONE PER INSERIRE UNA STAZIONE NELLA SELECT
function insersciStazione(stazione)
{
    // <option value=""></option>
    let option = $("<option value='"+stazione["latitudine"]+","+stazione["longitudine"]+"'>"+stazione["via"]+"</option>");

    $("#stazione").append(option);
}

let stazione = "";

// AGGIUNGO LA BICICLETTA
async function aggiungiBicicletta()
{
    stazione = $("#stazione").val();

    let statoControlli = doControlli();

    if(statoControlli != true)
    {
        alert(statoControlli);
        return;
    }

    let coordinate = stazione.split(",");
    
    let latitudine = coordinate[0];
    let longitudine = coordinate[1];

    let ultimoCodice = await richiestaJSON("../../services/getUltimoCodice.php");
    let codice = ultimoCodice + 1;

    // aggiungo la bicicletta
    let stato = await richiesta("../../services/aggiungiBicicletta.php", {codice: codice, latitudine: latitudine, longitudine: longitudine});

    if(stato == "")
    {
        alert("Bicicletta aggiunta");
        window.location.href = "../../pages/admin/visualizzaBiciclette.php";
    }
    else
        alert("Errore! Bicicletta non aggiunta");
}

// CONTROLLI SUI PARAMETRI IN INPUT
function doControlli()
{
    // parametri mancanti
    if(stazione == "")
        return "ERRORE! Inserire tutti i campi!";

    // tutto ok
    return true;
}