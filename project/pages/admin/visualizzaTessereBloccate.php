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

        <title>Tessere Bloccate Admin - BycicleRent</title>

        <!-- IMPORTO jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- IMPORTO LO SCRIPT -->
        <script src="../../script/richiesta.js"></script>
        <script src="../../script/admin/visualizzaTessereBloccate.js"></script>

    </head>

    <body>
        <h1>TESSERE BLOCCATE</h1>

        <!-- TESSERE -->
        <div id="tessere">

            <h2>TESSERE</h>
            <!-- 
                cliente: <input type="text" readonly="readonly">
                <a href="sbloccaTessera.php?cliente_id=X">SBLOCCA TESSERA</a>
                <a href="nuovaTessera.php?cliente_id=X">NUOVA TESSERA</a>
                <br>
            -->
        </div>

    </body>

</html>