<?php
    // prendo la sessione
    if(!isset($_SESSION))
        session_start();

    // parametri non passati
    if(!isset($_SESSION["stazione_id"]) && !isset($_GET["stazione_id"]))
    {
        echo "ERRORE! Parametri non passati";
        return;
    }

    // credenziali del database
    include_once("../util/credDb.php");
    global $server, $cliente, $psw, $dbBiciclette;

    // query
    include_once("../util/query.php");
    global $getPostiLiberiById;

    // connessione al database
    $connDB = new mysqli($server, $cliente, $psw, $dbBiciclette);

    // errore nella connessione al db
    if ($connDB->connect_error)
        die("Connessione con il database non riuscita: " . $connDB->connect_error);

    // statement
    $statement = $connDB->prepare($getPostiLiberiById);

    // parametri nello statement
    if(isset($_SESSION["stazione_id"]))
        $statement->bind_param("i", $_SESSION["stazione_id"]);
    else 
        $statement->bind_param("i", $_GET["stazione_id"]);

    // eseguo lo statement
    $statement->execute();

    // eseguo lo statement
    $statement->execute();

    // prendo il risultato
    $result = $statement->get_result()->fetch_assoc();

    echo json_encode($result["slot_liberi"]);
?>