<?php
    // prendo la sessione
    session_start();

    // utente non in sessione
    if(!isset($_SESSION['cliente_id'])) {
        header("Location: mappa.php");
        exit; 
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blocca Tessera - BycicleRent</title>

        <!-- IMPORTO jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- IMPORTO LO SCRIPT -->
        <script src="../script/richiesta.js"></script>
        <script src="../script/bloccaTessera.js"></script>

</head>
<body>
    
</body>
</html>