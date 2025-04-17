// PAGINA CARICATA
$(document).ready(async function()
{
    // blocco tessera
    let stato = await richiesta("../services/bloccaTessera.php");

    if(stato)
        alert("ERRORE! Operazione non eseguita");
    else
        alert("Operazione eseguita correttamente");
    
    window.location.href = "../pages/mappa.php";
});