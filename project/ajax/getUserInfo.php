<?php
session_start();
require_once("../class/gestioneDB.php");

$response = ["status" => false, "message" => "Errore durante il recupero delle informazioni del cliente."];

if (isset($_SESSION['id_user'])) {
    $gest = new gestioneDB();
    $gest->conn();

    $id = $_SESSION['id_user'];

    $query = $gest->connection->prepare("SELECT * FROM cliente WHERE ID=?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows > 0) {
        $response["status"] = true;
        $response["data"] = $result->fetch_assoc();
    } else {
        $response["message"] = "Nessun cliente trovato.";
    }

    $query->close();
    $gest->connection->close();
}

echo json_encode($response);
?>
