<?php
require_once("../class/gestioneDB.php");

if (!isset($_SESSION)) {
    session_start();
}

// Inizializza la classe gestioneDatabase
$gest = new gestioneDB();
$gest->conn();

// Inizializza la risposta JSON
$response = ["status" => false, "message" => ""];

// Controlla se i dati necessari sono presenti
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["numero_tessera"]) && isset($_POST["numero_carta_credito"]) && isset($_POST["via"]) && isset($_POST["città"]) && isset($_POST["provincia"]) && isset($_POST["regione"]) && isset($_POST["CAP"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $numero_tessera = $_POST['numero_tessera'];
    $numero_carta_credito = $_POST['numero_carta_credito'];
    $via = $_POST['via'];
    $città = $_POST['città'];
    $provincia = $_POST['provincia'];
    $regione = $_POST['regione'];
    $CAP = $_POST['CAP'];

    // Usa il metodo aggiungiUtente
    $response = $gest->aggiungiUtente($email, $password, $nome, $cognome, $numero_tessera, $numero_carta_credito, $via, $città, $provincia, $regione, $CAP);
} else {
    $response["message"] = "Dati mancanti.";
}

// Chiudi la connessione al database
$gest->connection->close();

// Restituisci la risposta JSON
echo json_encode($response);
?>
