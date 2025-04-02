<?php
    require_once("../class/gestioneDB.php");
    $response = ["status" => false, "message" => "Errore durante l'aggiunta della bicicletta."];

    if (isset($_POST['codice'], $_POST['GPS'], $_POST['RFID'], $_POST['posizione_attuale'])) {
        $gest = new gestioneDB();
        $gest->conn();

        $codice = $_POST['codice'];
        $GPS = $_POST['GPS'];
        $RFID = $_POST['RFID'];
        $posizione_attuale = $_POST['posizione_attuale'];

        if ($gest->addBike($codice, $GPS, $RFID, $posizione_attuale)) {
            $response["status"] = true;
            $response["message"] = "Bicicletta aggiunta con successo.";
        }

        $gest->connection->close();
    }

    echo json_encode($response);
?>
