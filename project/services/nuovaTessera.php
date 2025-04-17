<?php
    // prendo la sessione
    if(!isset($_SESSION))
        session_start();

    // non è admin
    if (!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] !== true) {
        echo "ERRORE! Non sei autenticato";
        return;
    }

    // parametri di sessione
    if (!isset($_SESSION["cliente_id"]) || !filter_var($_SESSION["cliente_id"], FILTER_VALIDATE_INT))
    {
        echo "ERRORE! Parametro di sessione 'cliente_id' non valido o non passato";
        return;
    }

    // credenziali del database
    include_once("../util/credDb.php");
    global $server, $cliente, $psw, $dbBiciclette;

    // query
    include_once("../util/query.php");
    global $nuovaTessera, $lastCodiceTessera;

    // connessione al database
    $connDB = new mysqli($server, $cliente, $psw, $dbBiciclette);

    // errore nella connessione al db
    if ($connDB->connect_error)
        die("Connessione con il database non riuscita: " . $connDB->connect_error);

    // prendo codice tessera più grande
    $statement = $connDB->prepare($lastCodiceTessera);

    // eseguo lo statement
    $statement->execute();

    // prendo il risultato
    $result = $statement->get_result()->fetch_assoc();

    $temp = $result["codice"];
    $codice = $temp+1;

    // statement
    $statement = $connDB->prepare($nuovaTessera);

    // parametri nello statement
    $statement->bind_param("ii", $codice, $_SESSION["cliente_id"]);

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