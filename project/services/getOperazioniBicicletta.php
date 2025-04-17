<?php
    // prendo la sessione
    if(!isset($_SESSION))
        session_start();

    // parametri non passati
    if(!isset($_SESSION["bicicletta_id"]))
    {
        echo "ERRORE! Parametri non passati";
        return;
    }

    // credenziali del database
    include_once("../util/credDb.php");
    global $server, $cliente, $psw, $dbBiciclette;

    // query
    include_once("../util/query.php");
    global $getOperazioniBicicletta;

    // connessione al database
    $connDB = new mysqli($server, $cliente, $psw, $dbBiciclette);

    // errore nella connessione al db
    if ($connDB->connect_error)
        die("Connessione con il database non riuscita: " . $connDB->connect_error);

    // statement
    $statement = $connDB->prepare($getOperazioniBicicletta);

    // parametri nello statement
    $statement->bind_param("i", $_SESSION["bicicletta_id"]);

    // eseguo lo statement
    $statement->execute();

    // eseguo lo statement
    $statement->execute();

    // prendo il risultato
    $result = $statement->get_result();

    $operazioni = array();

    while(($row = $result->fetch_assoc()) != null)
    {
        $operazioni[] = $row;
    }

    echo json_encode($operazioni);
?>