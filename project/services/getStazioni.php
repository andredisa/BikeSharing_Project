<?php
    // prendo la sessione
    if(!isset($_SESSION))
        session_start();

    // credenziali del database
    include_once("../util/credDb.php");
    global $server, $cliente, $psw, $dbBiciclette;

    // query
    include_once("../util/query.php");
    global $getStazioni, $getStazione;

    // connessione al database
    $connDB = new mysqli($server, $cliente, $psw, $dbBiciclette);

    // errore nella connessione al db
    if ($connDB->connect_error)
        die("Connessione con il database non riuscita: " . $connDB->connect_error);

    // statement
    $statement;

    // stazione_id passato
    if(isset($_SESSION["stazione_id"]))
    {
        $statement = $connDB->prepare($getStazione);

        $statement->bind_param("i", $_SESSION["stazione_id"]);
    }
    else
        $statement = $connDB->prepare($getStazioni);

    // eseguo lo statement
    $statement->execute();

    // prendo il risultato
    $result = $statement->get_result();

    $stazioni = array();

    while(($row = $result->fetch_assoc()) != null)
    {
        $stazioni[] = $row;
    }

    echo json_encode($stazioni);
?>