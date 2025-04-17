// PAGINA CARICATA
$(document).ready(async function()
{
    // nuova tessera
    let stato = await richiesta("../../services/nuovaTessera.php");

    if(stato)
        alert("ERRORE! Operazione non eseguita");
    else
        alert("Operazione eseguita correttamente");
    
    window.location.href = "visualizzaTessereBloccate.php";
});