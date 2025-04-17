<?php
    // prendo la sessione
    if(!isset($_SESSION))
        session_start();

    // cliente non autenticato
    if(!isset($_SESSION["cliente_id"]))
    {
        echo "ERRORE! Non sei autenticato";
        return;
    }

    // credenziali del database
    include_once("../util/credDb.php");
    global $server, $cliente, $psw, $dbBiciclette;

    // query
    include_once("../util/query.php");
    global $getIndirizzo;

    // connessione al database
    $connDB = new mysqli($server, $cliente, $psw, $dbBiciclette);

    // errore nella connessione al db
    if ($connDB->connect_error)
        die("Connessione con il database non riuscita: " . $connDB->connect_error);

    // statement
    $statement = $connDB->prepare($getIndirizzo);

    // parametri nello statement
    $statement->bind_param("i", $_SESSION["cliente_id"]);

    // eseguo lo statement
    $statement->execute();

    // prendo il risultato
    $result = $statement->get_result()->fetch_assoc();

    echo json_encode($result["indirizzo"]);
?>