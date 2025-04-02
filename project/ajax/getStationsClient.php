<?php
// Include the ghost_file.php file
include '../ghost_file.php';

// Use the variables from ghost_file.php
global $servername, $username, $password, $dbname;


// Creazione connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controllo connessione
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query per ottenere le stazioni
$sql = "SELECT latitudine AS lat, longitudine AS lnge FROM stazione";
$result = $conn->query($sql);

$stazioni = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stazioni[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($stazioni);
?>