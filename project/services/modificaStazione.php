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

    // parametri non passati o non validi
    $requiredParams = ["via", "latitudine", "longitudine", "slotMax"];
    foreach ($requiredParams as $param) {
        if (!isset($_GET[$param])) {
            echo "ERRORE! Parametro '$param' non passato";
            return;
        }
    }

    // validazione dei parametri
    $via = filter_var($_GET["via"], FILTER_SANITIZE_SPECIAL_CHARS);
    $latitudine = filter_var($_GET["latitudine"], FILTER_VALIDATE_FLOAT);
    $longitudine = filter_var($_GET["longitudine"], FILTER_VALIDATE_FLOAT);
    $slotMax = filter_var($_GET["slotMax"], FILTER_VALIDATE_INT);

    if ($via === false || $latitudine === false || $longitudine === false || $slotMax === false) {
        echo "ERRORE! Parametri non validi";
        return;
    }

    // parametri di sessione
    if (!isset($_SESSION["stazione_id"]) || !filter_var($_SESSION["stazione_id"], FILTER_VALIDATE_INT))
    {
        echo "ERRORE! Parametro di sessione 'stazione_id' non valido o non passato";
        return;
    }

    // credenziali del database
    include_once("../util/credDb.php");
    global $server, $cliente, $psw, $dbBiciclette;

    // query
    include_once("../util/query.php");
    global $modificaStazione;

    // connessione al database
    $connDB = new mysqli($server, $cliente, $psw, $dbBiciclette);

    // errore nella connessione al db
    if ($connDB->connect_error)
        die("Connessione con il database non riuscita: " . $connDB->connect_error);

    // statement
    $statement = $connDB->prepare($modificaStazione);

    // parametri nello statement
    $statement->bind_param("sddii", $_GET["via"], $_GET["latitudine"], $_GET["longitudine"], $_GET["slotMax"], $_SESSION["stazione_id"]);

    // eseguo lo statement
    $statement->execute();

    // prendo il risultato
    $result = $statement->get_result();

    // ritorno !result perche' get_result() ritorna false se non ci sono stati errori
    echo json_encode(!$result);
?>