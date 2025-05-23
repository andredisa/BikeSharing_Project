<?php
    // prendo la sessione
    if(!isset($_SESSION))
        session_start();

    // credenziali del database
    include_once("../util/credDb.php");
    global $server, $cliente, $psw, $dbBiciclette;

    // query
    include_once("../util/query.php");
    global $getBiciclette, $getBicicletta;

    // connessione al database
    $connDB = new mysqli($server, $cliente, $psw, $dbBiciclette);

    // errore nella connessione al db
    if ($connDB->connect_error)
        die("Connessione con il database non riuscita: " . $connDB->connect_error);

    // statement
    $statement;

    // stazione_id passato
    if(isset($_SESSION["bicicletta_id"]))
    {
        $statement = $connDB->prepare($getBicicletta);

        $statement->bind_param("i", $_SESSION["bicicletta_id"]);
    }
    else
        $statement = $connDB->prepare($getBiciclette);

    // eseguo lo statement
    $statement->execute();

    // prendo il risultato
    $result = $statement->get_result();

    $biciclette = array();

    while(($row = $result->fetch_assoc()) != null)
    {
        $biciclette[] = $row;
    }

    echo json_encode($biciclette);
?>