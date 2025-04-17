<?php
    // prendo la sessione
    session_start();

    // utente in sessione
    if(isset($_SESSION['cliente_id'])) {
        header("Location: mappa.php");
        exit; // Assicurati di terminare lo script dopo aver reindirizzato
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - BycicleRent</title>

    <!-- IMPORTO jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Aggiungi Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- IMPORTO LO SCRIPT -->
    <script src="../script/login.js"></script>

</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h1 class="mb-0">LOGIN</h1>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="mail_username">Mail o Username:</label>
                                <input type="text" class="form-control" id="mail_username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" autocomplete="current-password">
                            </div>
                            <button type="button" class="btn btn-primary btn-block" onclick="doLogin()">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
