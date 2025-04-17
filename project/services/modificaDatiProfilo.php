<?php
    // prendo la sessione
    if(!isset($_SESSION))
        session_start();

    // parametri non passati
    if(!isset($_GET["nome"]) || !isset($_GET["cognome"]) || !isset($_GET["mail"]) || !isset($_GET["username"]) || !isset($_GET["latitudine"]) || !isset($_GET["longitudine"]) || !isset($_GET["indirizzo"]))
    {
        echo "ERRORE! Parametri non passati";
        return;
    }

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
    global $modificaDatiProfilo;

    // connessione al database
    $connDB = new mysqli($server, $cliente, $psw, $dbBiciclette);

    // errore nella connessione al db
    if ($connDB->connect_error)
        die("Connessione con il database non riuscita: " . $connDB->connect_error);

    // statement
    $statement = $connDB->prepare($modificaDatiProfilo);

    // parametri nello statement
    $statement->bind_param("sssssddi", $_GET["nome"], $_GET["cognome"], $_GET["mail"], $_GET["username"], $_GET["indirizzo"], $_GET["latitudine"], $_GET["longitudine"], $_SESSION["cliente_id"]);

    // eseguo lo statement
    $statement->execute();

    // prendo il risultato
    $result = $statement->get_result();

    // ritorno !result perche' get_result() ritorna false se non ci sono stati errori
    echo json_encode(!$result);
?>