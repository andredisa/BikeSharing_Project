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
    global $getUltimoCodice;

    // connessione al database
    $connDB = new mysqli($server, $cliente, $psw, $dbBiciclette);

    // errore nella connessione al db
    if ($connDB->connect_error)
        die("Connessione con il database non riuscita: " . $connDB->connect_error);

    // statement
    $statement = $connDB->prepare($getUltimoCodice);

    // eseguo lo statement
    $statement->execute();

    // eseguo lo statement
    $statement->execute();

    // prendo il risultato
    $result = $statement->get_result()->fetch_assoc();

    echo json_encode($result["codice"]);
?>