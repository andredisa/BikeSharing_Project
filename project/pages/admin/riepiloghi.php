<?php
    // prendo la sessione
    session_start();

    // admin non in sessione
    if(!isset($_SESSION['isAdmin']))
        header("Location: ../mappa.php");
    // else 
        // rimango su questa pagina

    // stazione id settato
    if(isset($_SESSION['stazione_id']))
        unset($_SESSION['stazione_id']); // tolgo stazione id

    // bicicletta id settato
    if(isset($_SESSION['bicicletta_id']))
        unset($_SESSION['bicicletta_id']); // tolgo bicicletta id
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Riepiloghi admin - BycicleRent</title>

        <!-- IMPORTO jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- IMPORTO LO SCRIPT -->
        <script src="../../script/richiesta.js"></script>
        <script src="../../script/admin/riepiloghi.js"></script>

    </head>

    <body>
        <h1>RIEPILOGHI ADMIN</h1>

        <!-- RIEPILOGO STAZIONI -->
        <div id="riepilogoStazioni">

            <h2>RIEPILOGO STAZIONI</h>
            <!-- 
                via stazione: <input type="text" readonly="readonly">
                <a href="stazione.php?stazione_id=X">VISUALIZZA REPILOGO STAZIONE</a>
                <br>
            -->
        </div>

        <br>

        <!-- RIEPILOGO BICICLETTE -->
        <div id="riepilogoBiciclette">

            <h2>RIEPILOGO BICICLETTE</h2>

            <!-- 
                codice bicicletta: <input type="text" readonly="readonly">
                <a href="biciletta.php?bicicletta_id=X">VISUALIZZA REPILOGO BICICLETTA</a>
                <br>
            -->

        </div>

    </body>

</html>