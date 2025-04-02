<?php
session_start();
require_once("../class/gestioneDB.php");

$response = ["status" => false, "message" => "Errore durante l'aggiornamento delle informazioni del cliente."];

if (isset($_SESSION['id_user'], $_GET['email'], $_GET['nome'], $_GET['cognome'], $_GET['numero_tessera'], $_GET['numero_carta_credito'], $_GET['via'], $_GET['città'], $_GET['provincia'], $_GET['regione'], $_GET['CAP'])) {
    $gest = new gestioneDB();
    $gest->conn();

    $id = $_SESSION['id_user'];
    $email = $_GET['email'];
    $nome = $_GET['nome'];
    $cognome = $_GET['cognome'];
    $numero_tessera = $_GET['numero_tessera'];
    $numero_carta_credito = $_GET['numero_carta_credito'];
    $via = $_GET['via'];
    $città = $_GET['città'];
    $provincia = $_GET['provincia'];
    $regione = $_GET['regione'];
    $CAP = $_GET['CAP'];

    if ($gest->updateUser($id, $email, $nome, $cognome, $numero_tessera, $numero_carta_credito, $via, $città, $provincia, $regione, $CAP)) {
        $response["status"] = true;
        $response["message"] = "Informazioni del cliente aggiornate con successo.";
    }

    $gest->connection->close();
}

echo json_encode($response);
?>
