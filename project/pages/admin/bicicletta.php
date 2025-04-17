<?php
    // prendo la sessione
    session_start();

    // admin non in sessione
    if(!isset($_SESSION['isAdmin']))
        header("Location: ../mappa.php");
    // else 
        // rimango su questa pagina

    if(!isset($_GET['bicicletta_id']))
        header("Location: riepiloghi.php");
    else
        $_SESSION['bicicletta_id'] = $_GET['bicicletta_id'];    // metto id bicicletta in sessione
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Riepiloghi bicicletta admin - BycicleRent</title>

        <!-- IMPORTO jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- IMPORTO LO SCRIPT -->
        <script src="../../script/richiesta.js"></script>
        <script src="../../script/admin/bicicletta.js"></script>

    </head>

    <body>
        <h1>RIEPILOGHI BICICLETTA ADMIN</h1>

        <!-- RIEPILOGO BICICLETTA -->
        <div id="riepilogoBicicletta">

            <h2>RIEPILOGO BICICLETTA</h>
            <!-- 
                codice bicicletta: <input type="text" readonly="readonly">
                <br>
                km totali percorsi: <input type="text" readonly="readonly">
                <br>
                numero operazioni effettuate: <input type="text" readonly="readonly">
            -->
        </div>

        <!-- RIEPILOGO OPERAZIONI -->
        <div id="riepilogoOperazioni">

            <h2>RIEPILOGO OPERAZIONI</h>
            <!-- 
                tipo operazione: <input type="text" readonly="readonly">
                <br>
                data e ora: <input type="text" readonly="readonly">
                <br>
                km percorsi: <input type="text" readonly="readonly">
            -->
        </div>

    </body>

</html>