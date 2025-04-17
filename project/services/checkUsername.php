<?php
    // prendo la sessione
    session_start();

    // parametri non passati
    if(!isset($_GET["username"]))
    {
        echo "ERRORE! Parametri non passati";
        return;
    }

    // credenziali del database
    include_once("../util/credDb.php");
    global $server, $cliente, $psw, $dbBiciclette;

    // query
    include_once("../util/query.php");
    global $checkUsername;

    // connessione al database
    $connDB = new mysqli($server, $cliente, $psw, $dbBiciclette);

    // errore nella connessione al db
    if ($connDB->connect_error)
        die("Connessione con il database non riuscita: " . $connDB->connect_error);

    // statement
    $statement = $connDB->prepare($checkUsername);

    // parametri nello statement
    $statement->bind_param("s", $_GET["username"]);

    // eseguo lo statement
    $statement->execute();

    // prendo il risultato
    $result = $statement->get_result();

    $return;

    // username già usato
    if ($result->num_rows == 1) 
    {
        // chiudo connessione al database
        $connDB->close();

        // return
        $return = true;
    }
    else
    {
        // chiudo connessione al database
        $connDB->close();

        // return
        $return = false;
    }

    echo $return;
?>