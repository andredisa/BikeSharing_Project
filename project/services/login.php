<?php
    // prendo la sessione
    session_start();

    // parametri non passati
    if(!isset($_GET["mail_username"]) || !isset($_GET["password"]))
    {
        echo "ERRORE! Parametri non passati";
        return;
    }

    // credenziali del database
    include_once("../util/credDb.php");
    global $server, $cliente, $psw, $dbBiciclette;

    // query
    include_once("../util/query.php");
    global $checkLoginCliente_Mail, $checkLoginCliente_Username, $checkLoginAdmin;

    // connessione al database
    $connDB = new mysqli($server, $cliente, $psw, $dbBiciclette);

    // errore nella connessione al db
    if ($connDB->connect_error)
        die("Connessione con il database non riuscita: " . $connDB->connect_error);

    // se è admin
    if (strpos($_GET["mail_username"], "@admin") !== false)
    {
        // login admin
        if (doLoginAdmin($connDB, $checkLoginAdmin) === true)
        {
            // chiudo connessione al database
            $connDB->close();
            echo true;
        }
        else
        {
            $connDB->close();
            echo false;
        }
    } else
    {
        // login come cliente

        // login con mail
        if (doLogin($connDB, $checkLoginCliente_Mail) === true)
        {
            // chiudo connessione al database
            $connDB->close();
            echo true;
        }
        else
        {
            // login con username
            $result = doLogin($connDB, $checkLoginCliente_Username);
            // chiudo connessione al database
            $connDB->close();
            echo $result;
        }
    }

    // LOGIN COME CLIENTE
    function doLogin($connDB, $query)
    {
        // prendo i parametri
        $mail_username = $_GET["mail_username"];
        // password in md5
        $password = md5($_GET["password"]);

        // statement
        $statement = $connDB->prepare($query);

        // parametri nello statement
        $statement->bind_param("ss", $mail_username, $password);

        // eseguo lo statement
        $statement->execute();

        // prendo il risultato
        $result = $statement->get_result();

        // login corretta
        if ($result->num_rows == 1) 
        {
            // prendo i dati del cliente
            $cliente = $result->fetch_assoc();

            // salvo id cliente in sessione
            $_SESSION["cliente_id"] = $cliente["cliente_id"];

            // return
            return true;
        }
                 
        return false;
    }

    // LOGIN COME ADMIN
    function doLoginAdmin($connDB, $query)
    {
        // prendo i parametri
        $mail_username = $_GET["mail_username"];
        // password in md5
        $password = md5($_GET["password"]);

        // statement
        $statement = $connDB->prepare($query);

        // parametri nello statement
        $statement->bind_param("ss", $mail_username, $password);

        // eseguo lo statement
        $statement->execute();

        // prendo il risultato
        $result = $statement->get_result();

        // login corretta
        if ($result->num_rows == 1) 
        {
            // prendo i dati dell'admin
            $admin = $result->fetch_assoc();

            // salvo admin in sessione
            $_SESSION["isAdmin"] = true;
            $_SESSION["admin"] = $admin;

            // return
            return true;
        }
                 
        return false;
    }
?>
