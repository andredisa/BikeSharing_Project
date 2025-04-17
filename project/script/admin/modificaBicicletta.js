// PAGINA CARICATA
$(document).ready(async function()
{
    // prendo la bicicletta
    let bicicletta = await getBicicletta();

    // visualizzo bicicletta
    visualizzaBicicletta(bicicletta);
});

// dati modificabili
let codice = "";
let km_percorsi = "";

// PRENDO LA STAZIONE
async function getBicicletta()
{
    // chiamata al db
    let bicicletta = await richiestaJSON("../../services/getBiciclette.php");

    return bicicletta[0];
}

// VISUALIZZO BICICLETTA
async function visualizzaBicicletta(bicicletta)
{
    $("#codice").val(bicicletta["codice"]);
    $("#km_percorsi").val(bicicletta["km_percorsi"]);
}

// MODIFICA DATI DELLA BICICLETTA
async function modificaBicicletta()
{
    codice = $("#codice").val();
    km_percorsi = $("#km_percorsi").val();

    // modifico i dati nel database
    let stato = await richiestaJSON("../../services/modificaBicicletta.php", {codice:codice, km_percorsi: km_percorsi});

    if(stato == true)
    {
        alert("Bicicletta modificata");
        window.location.href = "../../pages/admin/visualizzaBiciclette.php";
    }
    else
        alert("Errore! Dati non modificati");
}