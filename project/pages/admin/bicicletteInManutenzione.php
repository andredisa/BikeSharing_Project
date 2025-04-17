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

        <title>Biciclette In Manutenzione - BycicleRent</title>

        <!-- IMPORTO jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- IMPORTO LO SCRIPT -->
        <script src="../../script/richiesta.js"></script>
        <script src="../../script/admin/bicicletteInManutenzione.js"></script>

    </head>

    <body>
        <h1>BICICLETTE IN MANUTENZIONE</h1>

        <!-- BICICLETTE IN MANUTENZIONE -->
        <div id="biciclette">

            <h2>BICICLETTE</h2>

            <!-- 
                codice bicicletta: <input type="text" readonly="readonly"><br>
                km percorsi: <input type="text" readonly="readonly">
                <br>
            -->

        </div>

        <br><br>
        <a href="../mappa.php">Torna alla mappa</a>

    </body>

</html>