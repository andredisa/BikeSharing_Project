<?php
    // prendo la sessione
    if(!isset($_SESSION))
        session_start();

    // non è admin
    if(!isset($_SESSION["isAdmin"]))
    {
        echo "ERRORE! Non sei autenticato";
        return;
    }

    // credenziali del database
    include_once("../util/credDb.php");
    global $server, $cliente, $psw, $dbBiciclette;

    // query
    include_once("../util/query.php");
    global $getTessereBloccate;

    // connessione al database
    $connDB = new mysqli($server, $cliente, $psw, $dbBiciclette);

    // errore nella connessione al db
    if ($connDB->connect_error)
        die("Connessione con il database non riuscita: " . $connDB->connect_error);

    // statement
    $statement = $connDB->prepare($getTessereBloccate);

    // eseguo lo statement
    $statement->execute();

    // prendo il risultato
    $result = $statement->get_result();

    $tessere = array();

    while(($row = $result->fetch_assoc()) != null)
    {
        $tessere[] = $row;
    }

    echo json_encode($tessere);
?>