<?php
    // prendo la sessione
    session_start();

    // admin non in sessione
    if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
        header("Location: ../mappa.php");
        exit; 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Stazione - BycicleRent</title>

    <!-- IMPORTO jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- IMPORTO LO SCRIPT -->
    <script src="../../script/richiesta.js"></script>
    <script src="../../script/admin/aggiungiStazione.js"></script>
</head>
<body>

    <h1>AGGIUNGI STAZIONE</h1>

    via: <input type="text" id="via">
    <br>
    slot massimi disponibili: <input type="number" id="slotMax" min="1">
    <br>
    <button onclick="aggiungiStazione()">AGGIUNGI STAZIONE</button>
    
</body>
</html>