<?php

class gestioneDB
{
    public $connection;
    public $servername;
    public $username;
    public $password;
    public $dbname;


    public function __construct() {
        include '../ghost_file.php';
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }


    public function conn() {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    public function authenticateAdmin($email, $password)
    {
        $hashedPassword = md5($password);
        $query = $this->connection->prepare("SELECT * FROM admin WHERE email=? AND password=?");
        $query->bind_param("ss", $email, $hashedPassword);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        return $result->num_rows > 0;
    }

public function authenticateUser($email, $password)
    {
        $hashedPassword = md5($password);
        $query = $this->connection->prepare("SELECT * FROM cliente WHERE email=? AND password=?");
        $query->bind_param("ss", $email, $hashedPassword);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        return $result->num_rows > 0;
    }


    public function getAdminIDByEmail($email)
    {
        $userID = -1;
        $query = $this->connection->prepare("SELECT ID FROM admin WHERE email=?");
        $query->bind_param("s", $email);
        $query->execute();
        $query->bind_result($userID);
        $query->fetch();
        $query->close();

        return $userID;
    }

    public function getClienteIDByEmail($email)
    {
        $userID = -1;
        $query = $this->connection->prepare("SELECT ID FROM cliente WHERE email=?");
        $query->bind_param("s", $email);
        $query->execute();
        $query->bind_result($userID);
        $query->fetch();
        $query->close();

        return $userID;
    }

    // Metodo per aggiungere un nuovo utente
    public function aggiungiUtente($email, $password, $nome, $cognome, $numero_tessera, $numero_carta_credito, $via, $città, $provincia, $regione, $CAP) {
        $password = md5($password);

        // Verifica se l'email è già registrata
        $query = $this->connection->prepare("SELECT * FROM cliente WHERE email=?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $query->close();
            return ["status" => false, "message" => "Email già registrata."];
        }

        $query->close();

        // Inserisci il nuovo cliente
        $query = $this->connection->prepare("INSERT INTO cliente (email, password, nome, cognome, numero_tessera, numero_carta_credito, via, città, provincia, regione, CAP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssssisssssi", $email, $password, $nome, $cognome, $numero_tessera, $numero_carta_credito, $via, $città, $provincia, $regione, $CAP);

        if ($query->execute()) {
            $query->close();
            return ["status" => true, "message" => "Registrazione avvenuta con successo."];
        } else {
            $query->close();
            return ["status" => false, "message" => "Errore durante l'inserimento nel database."];
        }
    }
    public function addStation($codice, $numero_slot, $via, $città, $provincia, $regione, $CAP, $latitudine, $longitudine) {
        $query = $this->connection->prepare("INSERT INTO stazione (codice, numero_slot, via, città, provincia, regione, CAP, latitudine, longitudine) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("sissssidd", $codice, $numero_slot, $via, $città, $provincia, $regione, $CAP, $latitudine, $longitudine);
        return $query->execute();
    }
    

    public function removeStation($codice) {
        $query = $this->connection->prepare("DELETE FROM stazione WHERE codice=?");
        $query->bind_param("s", $codice);
        return $query->execute();
    }
    

    public function updateSlot($id, $numero_slot) {
        $query = $this->connection->prepare("UPDATE stazione SET numero_slot=? WHERE ID=?");
        $query->bind_param("ii", $numero_slot, $id);
        return $query->execute();
    }

    public function addBike($codice, $GPS, $RFID, $posizione_attuale) {
        $attiva = 1;
        $query = $this->connection->prepare("INSERT INTO bicicletta (codice, GPS, RFID, posizione_attuale, attiva) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param("ssssi", $codice, $GPS, $RFID, $posizione_attuale, $attiva);
        return $query->execute();
    }

    public function removeBike($codice) {
        $query = $this->connection->prepare("DELETE FROM bicicletta WHERE codice=?");
        $query->bind_param("s", $codice);
        return $query->execute();
    }
    

    public function updateUser($id, $email, $nome, $cognome, $numero_tessera, $numero_carta_credito, $via, $città, $provincia, $regione, $CAP) {
        $query = $this->connection->prepare("UPDATE cliente SET email=?, nome=?, cognome=?, numero_tessera=?, numero_carta_credito=?, via=?, città=?, provincia=?, regione=?, CAP=? WHERE ID=?");
        $query->bind_param("ssssssssssi", $email, $nome, $cognome, $numero_tessera, $numero_carta_credito, $via, $città, $provincia, $regione, $CAP, $id);
        return $query->execute();
    }
}

?>
