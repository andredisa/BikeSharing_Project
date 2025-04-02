<?php
require_once("../class/gestioneDB.php");

$response = ["status" => false, "message" => "Errore durante la rimozione della stazione."];

if (isset($_POST['codice'])) {
    $gest = new gestioneDB();
    $gest->conn();

    $codice = $_POST['codice'];

    if ($gest->removeStation($codice)) {
        $response["status"] = true;
        $response["message"] = "Stazione rimossa con successo.";
    }

    $gest->connection->close();
}

echo json_encode($response);
?>
