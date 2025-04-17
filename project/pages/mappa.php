<?php
    // prendo la sessione
    session_start();

    // anche l'utente non loggato può visualizzare la mappa
    // non controllo se l'utente è loggato perché non è un problema se non lo è
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mappa - BycicleRent</title>

    <!-- IMPORTO jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Includi la libreria Leaflet.js -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="../script/richiesta.js"></script>
    <script src="../script/mappa.js"></script>

    <!-- IMPORTO LO STILE -->
    <link rel="stylesheet" type="text/css" href="../style/mappa.css" />
    <!-- Includi il foglio di stile di Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Aggiungi Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        /* Stile personalizzato per il div della mappa */
        #map-container {
            height: 80vh; /* Altezza del 80% della viewport */
        }
    </style>

</head>

<body>

    <div class="container-fluid">

        <h1 class="text-center mt-5">MAPPA</h1>

        <div class="text-right mt-3">
            <?php
            // admin
            if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                ?>
                <a href="admin/visualizzaStazioni.php" class="btn btn-primary">STAZIONI</a>
                <a href="admin/visualizzaBiciclette.php" class="btn btn-primary">BICICLETTE</a>
                <a href="admin/riepiloghi.php" class="btn btn-primary">RIEPILOGHI</a>
                <a href="admin/visualizzaTessereBloccate.php" class="btn btn-primary">VISUALIZZA TESSERE BLOCCATE</a>
                <a href="logout.php" class="btn btn-danger">LOGOUT</a>
                <?php
            } else if(!isset($_SESSION['cliente_id'])) {
                // ospite
                ?>
                <a href="login.php" class="btn btn-primary">LOGIN</a>
                <a href="registrazione.php" class="btn btn-primary">REGISTRATI</a>
                <?php
            } else {
                ?>
                <a href="profilo.php" class="btn btn-primary">PROFILO</a>
                <a href="riepiloghi.php" class="btn btn-primary">RIEPILOGHI</a>
                <a href="bloccaTessera.php" class="btn btn-primary">BLOCCA TESSERA</a>
                <a href="logout.php" class="btn btn-danger">LOGOUT</a>
                <?php
            }
            ?>
        </div>

        <div class="mt-5" id="map-container"></div>

    </div>

</body>

</html>
