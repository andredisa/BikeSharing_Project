<?php
    // prendo la sessione
    session_start();

    // admin non in sessione
    if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
        header("Location: ../mappa.php");
        exit; 
    }

    // bicicletta id passto
    if(isset($_GET['bicicletta_id']))
        $_SESSION['bicicletta_id'] = $_GET['bicicletta_id'];
    else
        header("Location: visualizzaBiciclette.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Bicicletta - BycicleRent</title>

    <!-- IMPORTO jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- IMPORTO LO SCRIPT -->
    <script src="../../script/richiesta.js"></script>
    <script src="../../script/admin/modificaBicicletta.js"></script>
</head>
<body>

    <h1>MODIFICA BICICLETTA</h1>

    codice bicicletta: <input type="number" id="codice" min="0000" max="9999">
    <br>
    km percorsi: <input type="number" id="km_percorsi" min="0">
    <br>
    <button onclick="modificaBicicletta()">MODIFICA BICICLETTA</button>
    
</body>
</html>