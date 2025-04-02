<?php
    require_once("../class/gestioneDB.php");
    $response = ["status" => false, "message" => "Errore durante l'aggiornamento del numero di slot."];

    if (isset($_POST['slot_id'], $_POST['numero_slot_update'])) {
        $gest = new gestioneDB();
        $gest->conn();

        $id = $_POST['slot_id'];
        $numero_slot = $_POST['numero_slot_update'];

        if ($gest->updateSlot($id, $numero_slot)) {
            $response["status"] = true;
            $response["message"] = "Numero di slot aggiornato con successo.";
        }

        $gest->connection->close();
    }

    echo json_encode($response);
?>
