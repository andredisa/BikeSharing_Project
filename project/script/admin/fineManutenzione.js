// PAGINA CARICATA
$(document).ready(async function()
{
    // fine manutenzione bicicletta
    let stato = await richiesta("../../services/fineManutenzione.php");

    if(stato)
        alert("ERRORE! Operazione non eseguita");
    else
        alert("Operazione eseguita correttamente");
    
    window.location.href = "../../pages/admin/bicicletteInManutenzione.php";
});