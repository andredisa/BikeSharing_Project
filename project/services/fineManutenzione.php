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
    global $fineManutenzione;

    // connessione al database
    $connDB = new mysqli($server, $cliente, $psw, $dbBiciclette);

    // errore nella connessione al db
    if ($connDB->connect_error)
        die("Connessione con il database non riuscita: " . $connDB->connect_error);

    // statement
    $statement = $connDB->prepare($fineManutenzione);

    // parametri nello statement
    $statement->bind_param("i", $_SESSION["bicicletta_id"]);

    // eseguo lo statement
    $statement->execute();

    // prendo il risultato
    $result = $statement->get_result();

    $return;

    // fine manutenzione
    if ($result)
        $return = true;
    else
        $return = false;

    // chiudo connessione al database
    $connDB->close();

    echo $return;
?>