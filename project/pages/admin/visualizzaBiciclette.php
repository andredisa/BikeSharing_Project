<?php
    // prendo la sessione
    session_start();

    // admin non in sessione
    if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != true) {
        header("Location: ../mappa.php");
        exit; 
    }

    // Bicicletta ID settato
    if(isset($_SESSION['bicicletta_id'])) {
        unset($_SESSION['bicicletta_id']); // Tolgo bicicletta ID
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mappa Biciclette - BycicleRent</title>

    <!-- IMPORTO LO SCRIPT -->
    <!-- IMPORTO jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Includi la libreria Leaflet.js -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="../../script/richiesta.js"></script>
    <script src="../../script/admin/visualizzaBiciclette.js"></script>
    
    <!-- IMPORTO LO STILE -->
    <link rel="stylesheet" type="text/css" href="../../style/mappa.css" />
    <!-- Includi il foglio di stile di Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Aggiungi Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    
    <h1 class="text-center mt-5">MAPPA BICICLETTE</h1>

    <div class="container mt-3">
        <div class="row justify-content-end">
            <div class="col-md-6 text-right">
                <a href="aggiungiBicicletta.php" class="btn btn-primary">AGGIUNGI BICICLETTA</a>
                <a href="bicicletteInManutenzione.php" class="btn btn-primary">BICICLETTE IN MANUTENZIONE</a>
            </div>
        </div>
    </div>

    <div class="mt-5" id="map-container"></div>
    
</body>

</html>
