<?php
    // prendo la sessione
    session_start();

    // utente in sessione
    if(isset($_SESSION['cliente_id'])) {
        header("Location: mappa.php");
        exit; 
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrazione Fase 3 - BycicleRent</title>

    <!-- IMPORTO jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Aggiungi Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- IMPORTO LO SCRIPT -->
    <script src="../../script/registrazione/fase3.js"></script>

</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h1 class="mb-0">REGISTRAZIONE</h1>
                    </div>
                    <div class="card-body">
                        <form>
                            <h3 id="nome" class="mb-3"></h3>
                            <h3 id="cognome" class="mb-3"></h3>
                            <h3 id="username" class="mb-3"></h3>
                            <h3 id="mail" class="mb-3"></h3>
                            <div class="form-group">
                                <label for="indirizzo">Indirizzo:</label>
                                <input type="text" class="form-control" id="indirizzo">
                            </div>
                            <button type="button" class="btn btn-primary btn-block" onclick="avanti()">AVANTI</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
