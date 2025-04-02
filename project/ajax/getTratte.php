<?php
include '../ghost_file.php';
function getTratte($idCliente)
{

    // Use the variables from ghost_file.php
    global $servername, $username, $password, $dbname;



    $conn = new mysqli($servername, $username, $password, $dbname);

    // Controllo connessione
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query per ottenere le tratte percorse per un determinato cliente
    $sql = "SELECT tariffa, distanza_percorsa 
            FROM operazione 
            WHERE id_cliente = ? AND tipo = 'Riconsegna'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idCliente);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $tratte = array();
        while ($row = $result->fetch_assoc()) {
            $tratte[] = $row;
        }
        return $tratte;
    } else {
        return "Nessuna tratta trovata";
    }
}
?>