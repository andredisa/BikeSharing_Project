<?php

// Include the ghost_file.php file
include '../ghost_file.php';

function getOperazioni()
{
    // Use the variables from ghost_file.php
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Controllo connessione
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Query per ottenere un riepilogo delle operazioni e le informazioni sulla stazione
    $sql = "SELECT o.*, s.codice AS stazione_codice, s.via AS stazione_via, s.città AS stazione_città, s.provincia AS stazione_provincia, s.regione AS stazione_regione, s.CAP AS stazione_CAP 
            FROM operazione o
            INNER JOIN stazione s ON o.id_stazione = s.ID";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $operazioni = array();
        while ($row = $result->fetch_assoc()) {
            $operazioni[] = $row;
        }
        return $operazioni;
    } else {
        return "Nessuna operazione trovata";
    }
}
?>