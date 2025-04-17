// PAGINA CARICATA
$(document).ready(async function()
{
    // prendo tutte le tessere bloccate
    let tessere = await getTessere();

    // visualizzo tessere
    visualizzaTessere(tessere);
});

// PRENDO LE TESSERE BLOCCATE
async function getTessere()
{
    // chiamata al db
    let tessere = await richiestaJSON("../../services/getTessereBloccate.php");

    return tessere;
}

// VISUALIZZO LE TESSERE BLOCCATE
async function visualizzaTessere(tessere)
{
    tessere.forEach(tessera => {
        visualizzaTessera(tessera);
    });
}

// FUNZIONE PER VISUALIZZARE UNA TESSERA
async function visualizzaTessera(tessera)
{
    // creo il div
    let div = $("<div></div>")

    // elemento per il nome del cliente
    let cliente = $("<input type='text' readonly='readonly'>")
    cliente.val(tessera["nome"] + " " + tessera["cognome"]);
    div.append("cliente: ");
    div.append(cliente);

    // elemento per il link sblocca tessera
    let urlSblocca = "sbloccaTessera.php?cliente_id="+tessera["cliente_id"];
    let linkSblocca = $("<a href='"+urlSblocca+"'>SBLOCCA TESSERA</a>")
    div.append(linkSblocca);
    div.append(" -- ");

    // elemento per il link sblocca tessera
    let urlNuova = "nuovaTessera.php?cliente_id="+tessera["cliente_id"];
    let linkNuova = $("<a href='"+urlNuova+"'>NUOVA TESSERA</a>")
    div.append(linkNuova);
    div.append("<br>");

    $("#tessere").append(div);
    $("#tessere").append($("<br>"));
}