<?php
    require_once("../class/gestioneDB.php");

    if(!isset($_SESSION)) {
        session_start();
    }

    // Inizializza la classe gestioneDatabase
    $gest = new gestioneDB();
    $gest->conn();

    // Inizializza la risposta JSON
    $response = ["status" => false];

    if(isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Controllo se è un admin
        $is_admin = $gest->authenticateAdmin($email, $password);
        if($is_admin === true) {
            $id_admin=$gest->getAdminIDByEmail($email);
            $_SESSION["id_user"] = $id_admin;
            $_SESSION["admin"] = true;

            $response["status"] = "admin";
        } elseif($is_admin === false) {
            // Se non è admin, controllo se è un cliente
            $is_cliente = $gest->authenticateUser($email, $password);
            if($is_cliente === true) {
                $id_cliente=$gest->getClienteIDByEmail($email);
                $_SESSION["id_user"] = $id_cliente;
                $_SESSION["admin"] = false;
                $response["status"] = "cliente";
            }
        }
    }

    // Chiudi la connessione al database
    $gest->connection->close();

    // Restituisci la risposta JSON
    echo json_encode($response);
?>
