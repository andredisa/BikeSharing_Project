<?php
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['admin']) || $_SESSION['admin'] == true) {
    header("Location: ../index.html");
    exit();
}
?>



<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8KBPTsGGJ62sLsC2pHgh_B-KCyNW_Vhw&callback=initMap" async ></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <script src="../script/initMapCliente.js"></script>
    <script>
    $(document).ready(function() {
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 45.4642, lng: 9.1900},
                zoom: 12
            });
            loadStations(map);
        }

        function loadUserInfo() {
            $.ajax({
                url: '../ajax/getUserInfo.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if(response.status) {
                        $('#userInfo').html(`
                            <p>Email: ${response.data.email}</p>
                            <p>Nome: ${response.data.nome}</p>
                            <p>Cognome: ${response.data.cognome}</p>
                            <p>Numero Tessera: ${response.data.numero_tessera}</p>
                            <p>Numero Carta di Credito: ${response.data.numero_carta_credito}</p>
                            <p>Via: ${response.data.via}</p>
                            <p>Città: ${response.data.città}</p>
                            <p>Provincia: ${response.data.provincia}</p>
                            <p>Regione: ${response.data.regione}</p>
                            <p>CAP: ${response.data.CAP}</p>
                        `);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Errore durante la richiesta AJAX.');
                }
            });
        }

        function updateUserInfo() {
            $.ajax({
                url: '../ajax/updateUser.php',
                type: 'GET',
                data: $('#updateUserForm').serialize(),
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Errore durante la richiesta AJAX.');
                }
            });
        }

        $('#viewInfoBtn').click(function() {
            loadUserInfo();
            $('#userInfo').show();
            $('#updateUserForm').hide();
        });

        $('#editInfoBtn').click(function() {
            loadUserInfo();
            $('#userInfo').hide();
            $('#updateUserForm').show();
        });

        $('#updateUserForm').on('submit', function(event) {
            event.preventDefault();
            updateUserInfo();
        });

        initMap();
    });
    </script>
</head>
<body>
    <h1>Benvenuto!</h1>
    <div id="map"></div>
    <button id="viewInfoBtn">Visualizza informazioni</button>
    <button id="editInfoBtn">Modifica informazioni</button>
    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>
    <div id="userInfo" style="display:none;"></div>
    <form id="updateUserForm" style="display:none;">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" required>
        </div>
        <div class="form-group">
            <label for="numero_tessera">Numero Tessera:</label>
            <input type="text" id="numero_tessera" name="numero_tessera" required>
        </div>
        <div class="form-group">
            <label for="numero_carta_credito">Numero Carta di Credito:</label>
            <input type="text" id="numero_carta_credito" name="numero_carta_credito" required>
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
        <button type="submit" class="btn btn-primary">Aggiorna Profilo</button>
    </form>

    <?php
/*
    <!-- Sezione per il riepilogo delle operazioni -->
    <h2>Riepilogo Operazioni</h2>
    <table border="1">
      <tr>
        <th>ID Operazione</th>
        <th>Distanza Percorsa</th>
        <th>Tipo</th>
        <th>Tariffa</th>
        <th>Data e Ora</th>
        <th>Stazione</th>
      </tr>
      <?php
        include '../ajax/getOperazioni.php';
        
        // Ottieni il riepilogo delle operazioni
        $operazione =  getOperazioni();
        
        // Mostra i risultati
        foreach($operazioni as $operazione) {
          echo "<tr>";
          echo "<td>".$operazione['ID']."</td>";
          echo "<td>".$operazione['distanza_percorsa']."</td>";
          echo "<td>".$operazione['tipo']."</td>";
          echo "<td>".$operazione['tariffa']."</td>";
          echo "<td>".$operazione['data_ora']."</td>";
          echo "<td>".$operazione['id_stazione']."</td>";
          echo "</tr>";
        }
      ?>
    </table>

    <!-- Sezione per le tratte percorse -->
    <h2>Tratte Percorse</h2>
    <table border="1">
      <tr>
        <th>Tariffa</th>
        <th>Distanza Percorsa</th>
      </tr>
      <?php
        include '../ajax/getTratte.php';
        
        // Ottieni le tratte percorse
        $tratte = getTratte($_SESSION['id_user']);
        
        // Mostra i risultati
        foreach($tratte as $tratta) {
          echo "<tr>";
          echo "<td>".$tratta['tariffa']."</td>";
          echo "<td>".$tratta['distanza_percorsa']."</td>";
          echo "</tr>";
        }
      ?>
    </table>
*/
?>

</body>
</html>
