<?php
    // prendo la sessione
    session_start();

    // admin non in sessione
    if(!isset($_SESSION['isAdmin']))
        header("Location: ../mappa.php");
    // else 
        // rimango su questa pagina

    // bicicletta id settato
    if(isset($_GET['bicicletta_id']))
        $_SESSION['bicicletta_id'] = $_GET['bicicletta_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- IMPORTO jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- IMPORTO LO SCRIPT -->
    <script src="../../script/richiesta.js"></script>
    <script src="../../script/admin/fineManutenzione.js"></script>
</head>
<body>
    
</body>
</html>