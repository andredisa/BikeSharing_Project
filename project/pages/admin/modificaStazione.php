<?php
    // prendo la sessione
    session_start();

    // admin non in sessione
    if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
        header("Location: ../mappa.php");
        exit; 
    }

    // stazione id passto
    if(isset($_GET['stazione_id']))
        $_SESSION['stazione_id'] = $_GET['stazione_id'];
    else
        header("Location: visualizzaStazioni.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Stazione - BycicleRent</title>

    <!-- IMPORTO jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- IMPORTO LO SCRIPT -->
    <script src="../../script/richiesta.js"></script>
    <script src="../../script/admin/modificaStazione.js"></script>
</head>
<body>

    <h1>MODIFICA STAZIONE</h1>

    via stazione: <input type="text" id="via">
    <br>
    slot massimi disponibili: <input type="number" id="slotMax" min="1">
    <br>
    <button onclick="modificaStazione()">MODIFICA STAZIONE</button>
    
</body>
</html>