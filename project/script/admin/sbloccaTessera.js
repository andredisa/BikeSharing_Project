// PAGINA CARICATA
$(document).ready(async function()
{
    // sblocco tessera
    let stato = await richiesta("../../services/sbloccaTessera.php");

    if(stato)
        alert("ERRORE! Operazione non eseguita");
    else
        alert("Operazione eseguita correttamente");
    
    window.location.href = "visualizzaTessereBloccate.php";
});