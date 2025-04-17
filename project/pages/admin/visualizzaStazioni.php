<?php
    // prendo la sessione
    session_start();

    // admin non in sessione
    if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
        header("Location: ../mappa.php");
        exit; 
    }

    // stazione id settato
    if(isset($_SESSION['stazione_id'])) {
        unset($_SESSION['stazione_id']); // tolgo stazione id
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mappa Stazioni - BycicleRent</title>

    <!-- IMPORTO jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Aggiungi Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- IMPORTO LO SCRIPT -->
    <!-- Includi la libreria Leaflet.js -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="../../script/richiesta.js"></script>
    <script src="../../script/admin/visualizzaStazioni.js"></script>

    <!-- IMPORTO LO STILE -->
    <link rel="stylesheet" type="text/css" href="../../style/mappa.css" />
    <!-- Includi il foglio di stile di Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">MAPPA STAZIONI</h1>
        <div class="text-right mb-3">
            <a href="aggiungiStazione.php" class="btn btn-primary">AGGIUNGI STAZIONE</a>
        </div>
    </div>

    <div class="mt-5" id="map-container"></div>

</body>

</html>
