<?php
    // prendo la sessione
    session_start();

    // parametri non passati
    if(!isset($_GET["nome"]) || !isset($_GET["cognome"]) 
    || !isset($_GET["username"]) || !isset($_GET["mail"]) || !isset($_GET["password"]) 
    || !isset($_GET["latitudine"]) || !isset($_GET["longitudine"]) 
    || !isset($_GET["indirizzo"]) || !isset($_GET["nomeTitolareCarta"]) || !isset($_GET["cognomeTitolareCarta"]) 
    || !isset($_GET["numeroCarta"]) || !isset($_GET["scadenzaCarta"]) || !isset($_GET["cvvCarta"]))
    {
        echo "ERRORE! Parametri non passati";
        return;
    }

    // validazione dei parametri
    $nome = filter_var($_GET["nome"], FILTER_SANITIZE_SPECIAL_CHARS);
    $cognome = filter_var($_GET["cognome"], FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_var($_GET["username"], FILTER_SANITIZE_SPECIAL_CHARS);
    $mail = filter_var($_GET["mail"], FILTER_SANITIZE_SPECIAL_CHARS);
    $latitudine = filter_var($_GET["latitudine"], FILTER_VALIDATE_FLOAT);
    $longitudine = filter_var($_GET["longitudine"], FILTER_VALIDATE_FLOAT);
    $cognomeTitolareCarta = filter_var($_GET["cognomeTitolareCarta"], FILTER_SANITIZE_SPECIAL_CHARS);
    $nomeTitolareCarta = filter_var($_GET["nomeTitolareCarta"], FILTER_SANITIZE_SPECIAL_CHARS);
    $scadenzaCarta = filter_var($_GET["scadenzaCarta"], FILTER_SANITIZE_SPECIAL_CHARS);
    $cvvCarta = filter_var($_GET["cvvCarta"], FILTER_SANITIZE_SPECIAL_CHARS);
    $numeroCarta = filter_var($_GET["numeroCarta"], FILTER_SANITIZE_SPECIAL_CHARS);

    if ($nome === false || $cognome === false || $username === false || $mail === false || $latitudine === false || $longitudine === false || $cognomeTitolareCarta === false
    || $nomeTitolareCarta === false || $scadenzaCarta === false || $cvvCarta === false || $numeroCarta === false) {
        echo "ERRORE! Parametri non validi";
        return;
    }

    // controlla che numeroCarta sia lungo 16 caratteri e solo numeri
    if (!preg_match("/^\d{16}$/", $_GET["numeroCarta"])) {
        echo "ERRORE! Il parametro 'numeroCarta' deve contenere esattamente 16 cifre";
        return;
    }

    // controlla che cvvCarta sia lungo 3 caratteri e solo numeri
    if (!preg_match("/^\d{3}$/", $_GET["cvvCarta"])) {
        echo "ERRORE! Il parametro 'cvvCarta' deve contenere esattamente 3 cifre";
        return;
    }

    // mail errata
    

    // credenziali del database
    include_once("../util/credDb.php");
    global $server, $cliente, $psw, $dbBiciclette;

    // query
    include_once("../util/query.php");
    global $registrazione, $lastCodiceTessera;

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
    $statement = $connDB->prepare($registrazione);

    // password in md5
    $password = md5($_GET["password"]);

    // parametri nello statement
    $statement->bind_param("ssssssddsssssi", $_GET["nome"], $_GET["cognome"], $_GET["username"], $_GET["mail"], $password, $_GET["indirizzo"], $_GET["latitudine"], $_GET["longitudine"], $_GET["nomeTitolareCarta"], $_GET["cognomeTitolareCarta"], $_GET["numeroCarta"], $_GET["scadenzaCarta"], $_GET["cvvCarta"], $codice);

    // eseguo lo statement
    $statement->execute();

    // prendo il risultato
    $result = $statement->get_result();

    $return;

    // registrazione effettuata
    if ($result)
        $return = true;
    else
        $return = false;

    // chiudo connessione al database
    $connDB->close();

    echo $return;
?>