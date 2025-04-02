<?php
    require_once("../class/gestioneDB.php");

$db = new gestioneDB();
$db->conn();

$query = "SELECT latitudine AS lat, longitudine AS lng, codice FROM stazione";
$result = $db->connection->query($query);

$stazioni = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stazioni[] = $row;
    }
}

echo json_encode($stazioni);

$db->connection->close();
?>
