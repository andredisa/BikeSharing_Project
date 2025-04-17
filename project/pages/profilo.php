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

    <title>Profilo cliente - BycicleRent</title>

    <!-- IMPORTO jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Aggiungi Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- IMPORTO LO SCRIPT -->
    <script src="../script/richiesta.js"></script>
    <script src="../script/profilo.js"></script>

</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h1 class="mb-0">PROFILO CLIENTE</h1>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" id="nome" readonly>
                            </div>
                            <div class="form-group">
                                <label for="cognome">Cognome:</label>
                                <input type="text" class="form-control" id="cognome" readonly>
                            </div>
                            <div class="form-group">
                                <label for="mail">Mail:</label>
                                <input type="text" class="form-control" id="mail" readonly>
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" readonly>
                            </div>
                            <div class="form-group">
                                <label for="indirizzo">Indirizzo:</label>
                                <input type="text" class="form-control" id="indirizzo" readonly>
                            </div>
                            <a href="modificaDatiProfilo.php" class="btn btn-primary">MODIFICA DATI</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
