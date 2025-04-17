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

    <title>Riepiloghi cliente - BycicleRent</title>

    <!-- IMPORTO jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Aggiungi Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- IMPORTO LO SCRIPT -->
    <script src="../script/richiesta.js"></script>
    <script src="../script/riepiloghi.js"></script>

</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h1 class="mb-0">RIEPILOGHI CLIENTE</h1>
                    </div>
                    <div class="card-body">
                        <!-- SOMMARIO OPERAZIONI CON I DATI TOTALI -->
                        <div class="mb-4">
                            <h2>RIEPILOGO TOTALE</h2>
                            <div class="form-group row">
                                <label for="numeroTratteTotali" class="col-sm-4 col-form-label">Numero Tratte Totali:</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="numeroTratteTotali" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="chilometriTotali" class="col-sm-4 col-form-label">Chilometri Totali:</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="chilometriTotali" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="spesaTotale" class="col-sm-4 col-form-label">Spesa Totale:</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="spesaTotale" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- OPERAZIONI TRATTA PER TRATTA -->
                        <div id="trattaPerTratta">
                            <h2>RIEPILOGO TRATTA PER TRATTA</h2>
                            <!-- 
                            <div class="mb-4">
                                <div class="form-group row">
                                    <label for="tipo" class="col-sm-4 col-form-label">Tipo:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="tipo" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="data" class="col-sm-4 col-form-label">Data:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="data" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="chilometriFatti" class="col-sm-4 col-form-label">Chilometri Fatti:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="chilometriFatti" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tariffa" class="col-sm-4 col-form-label">Tariffa:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="tariffa" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pressoStazione" class="col-sm-4 col-form-label">Presso Stazione:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="pressoStazione" readonly>
                                    </div>
                                </div>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
