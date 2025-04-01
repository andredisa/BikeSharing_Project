<?php
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../index.html");
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8KBPTsGGJ62sLsC2pHgh_B-KCyNW_Vhw"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h1 {
            color: #333333;
            text-align: center;
        }
        h2 {
            color: #007bff;
            margin-top: 30px;
        }
        .section-header {
            border-bottom: 1px solid #ced4da;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .section-header h2 {
            margin-bottom: 20px;
        }
        .section-form {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        #map {
            height: 500px;
            width: 100%;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Page</h1>
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>

        <!-- Mappa -->
        <div id="map"></div>

        <!-- Aggiungi Stazione -->
        <section id="addStation">
            <div class="section-header">
                <h2>Aggiungi Stazione</h2>
            </div>
            <form id="addStationForm" class="section-form">
                <div class="form-group">
                    <label for="codice">Codice:</label>
                    <input type="text" id="codice" name="codice" required>
                </div>
                <div class="form-group">
                    <label for="numero_slot">Numero di Slot:</label>
                    <input type="number" id="numero_slot" name="numero_slot" required>
                </div>
                <div class="form-group">
                    <label for="via">Via:</label>
                    <input type="text" id="via" name="via" required>
                </div>
                <div class="form-group">
                    <label for="città">Città:</label>
                    <input type="text" id="città" name="città" required>
                </div>
                <div class="form-group">
                    <label for="provincia">Provincia:</label>
                    <input type="text" id="provincia" name="provincia" required>
                </div>
                <div class="form-group">
                    <label for="regione">Regione:</label>
                    <input type="text" id="regione" name="regione" required>
                </div>
                <div class="form-group">
                    <label for="CAP">CAP:</label>
                    <input type="text" id="CAP" name="CAP" required>
                </div>
                <div class="form-group">
                    <label for="latitudine">Latitudine:</label>
                    <input type="text" id="latitudine" name="latitudine" required>
                </div>
                <div class="form-group">
                    <label for="longitudine">Longitudine:</label>
                    <input type="text" id="longitudine" name="longitudine" required>
                </div>
                <button type="submit" class="btn btn-primary">Aggiungi Stazione</button>
            </form>
        </section>

        <!-- Aggiorna Slot -->
        <section id="updateSlot">
            <div class="section-header">
                <h2>Aggiorna Slot</h2>
            </div>
            <form id="updateSlotForm" class="section-form">
                <div class="form-group">
                    <label for="slot_id">ID Slot:</label>
                    <input type="text" id="slot_id" name="slot_id" required>
                </div>
                <div class="form-group">
                    <label for="numero_slot_update">Nuovo Numero di Slot:</label>
                    <input type="number" id="numero_slot_update" name="numero_slot_update" required>
                </div>
                <button type="submit" class="btn btn-primary">Aggiorna Slot</button>
            </form>
        </section>

        <!-- Rimuovi Stazione -->
        <section id="removeStation">
            <div class="section-header">
                <h2>Rimuovi Stazione</h2>
            </div>
            <form id="removeStationForm" class="section-form">
                <div class="form-group">
                    <label for="station_code">Codice Stazione:</label>
                    <input type="text" id="station_code" name="station_code" required>
                </div>
                <button type="submit" class="btn btn-danger">Rimuovi Stazione</button>
            </form>
        </section>

        <!-- Aggiungi Bicicletta -->
        <section id="addBike">
            <div class="section-header">
                <h2>Aggiungi Bicicletta</h2>
            </div>
            <form id="addBikeForm" class="section-form">
                <div class="form-group">
                    <label for="codice_bike">Codice:</label>
                    <input type="text" id="codice_bike" name="codice" required>
                </div>
                <div class="form-group">
                    <label for="GPS">GPS:</label>
                    <input type="text" id="GPS" name="GPS" required>
                </div>
                <div class="form-group">
                    <label for="RFID">RFID:</label>
                    <input type="text" id="RFID" name="RFID" required>
                </div>
                <div class="form-group">
                    <label for="posizione_attuale">Posizione Attuale:</label>
                    <input type="text" id="posizione_attuale" name="posizione_attuale" required>
                </div>
                <button type="submit" class="btn btn-primary">Aggiungi Bicicletta</button>
            </form>
        </section>

        <!-- Rimuovi Bicicletta -->
        <section id="removeBike">
            <div class="section-header">
                <h2>Rimuovi Bicicletta</h2>
            </div>
            <form id="removeBikeForm" class="section-form">
                <div class="form-group">
                    <label for="bike_codice">Codice Bicicletta:</label>
                    <input type="text" id="bike_codice" name="bike_codice" required>
                </div>
                <button type="submit" class="btn btn-danger">Rimuovi Bicicletta</button>
            </form>
        </section>
    </div>

    <script>
        let map;
        let markers = [];

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 45.465454, lng: 9.186516},
                zoom: 9,
            });
            loadStations();
        }

        function loadStations() {
            $.ajax({
                url: '../ajax/getStations.php',
                type: 'GET',
                dataType: 'json',
                success: function(stazioni) {
                    clearMarkers();
                    stazioni.forEach(function(stazione) {
                        let marker = new google.maps.Marker({
                            position: { lat: parseFloat(stazione.lat), lng: parseFloat(stazione.lng) },
                            map: map,
                            title: stazione.nome
                        });
                        markers.push(marker);
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Errore durante il caricamento delle stazioni.');
                }
            });
        }

        function clearMarkers() {
            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = [];
        }

        $(document).ready(function() {
            // Inizializza la mappa
            initMap();

            // Aggiungi Stazione
            $('#addStationForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '../ajax/addStation.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        console.log(response); // Aggiungi questo per registrare la risposta nel browser
                        alert(response.message);
                        loadStations();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // Aggiungi questo per registrare eventuali errori nella console del browser
                        alert('Errore durante la richiesta AJAX.');
                    }
                });
            });

            // Aggiorna Slot
            $('#updateSlotForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '../ajax/updateSlot.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Errore durante la richiesta AJAX.');
                    }
                });
            });

            // Rimuovi Stazione
            $('#removeStationForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '../ajax/removeStation.php',
                    type: 'POST',
                    data: { codice: $('#station_code').val() },
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message);
                        loadStations();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Errore durante la richiesta AJAX.');
                    }
                });
            });


            // Aggiungi Bicicletta
            $('#addBikeForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '../ajax/addBike.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Errore durante la richiesta AJAX.');
                    }
                });
            });

            // Rimuovi Bicicletta
            $('#removeBikeForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '../ajax/removeBike.php',
                    type: 'POST',
                    data: { codice: $('#bike_codice').val() }, // Invia il codice della bicicletta anziché l'ID
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Errore durante la richiesta AJAX.');
                    }
                });
            });
        });
    </script>
</body>
</html>
