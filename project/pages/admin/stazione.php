<?php
    // prendo la sessione
    session_start();

    // admin non in sessione
    if(!isset($_SESSION['isAdmin']))
        header("Location: ../mappa.php");
    // else 
        // rimango su questa pagina

    if(!isset($_GET['stazione_id']))
        header("Location: riepiloghi.php");
    else
        $_SESSION['stazione_id'] = $_GET['stazione_id'];    // metto id stazione in sessione
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Riepiloghi stazione admin - BycicleRent</title>

        <!-- IMPORTO jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- IMPORTO LO SCRIPT -->
        <script src="../../script/richiesta.js"></script>
        <script src="../../script/admin/stazione.js"></script>

    </head>

    <body>
        <h1>RIEPILOGHI STAZIONE ADMIN</h1>

        <!-- RIEPILOGO STAZIONE -->
        <div id="riepilogoStazione">

            <h2>RIEPILOGO STAZIONE</h>
            <!-- 
                via stazione: <input type="text" readonly="readonly">
                <br>
                slot massimi: <input type="text" readonly="readonly">
                <br>   
                numero operazioni effettuate: <input type="text" readonly="readonly">
                <br>
                slot disponibili: <input type="text" readonly="readonly">
            -->
        </div>

        <!-- RIEPILOGO OPERAZIONI -->
        <div id="riepilogoOperazioni">

            <h2>RIEPILOGO OPERAZIONI</h>
            <!-- 
                tipo operazione: <input type="text" readonly="readonly">
                <br>
                data e ora: <input type="text" readonly="readonly">
            -->
        </div>

    </body>

</html>