<?php
require_once("../classi/gestioneDB.php");
$gest = new gestioneDB();
$gest->conn();

$id_user = $_GET["id_user"];
$id_bicicletta = $_GET["id_bicicletta"];
$id_stazione = $_GET["id_stazione"];

$operazione = $_GET["operazione"];
$distanza_percorsa = $_GET["distanza_percorsa"];
$tariffa = $distanza_percorsa * 0.80;
$ora = date('Y/m/d H:i:s');

if ($operazione == "riconsegna") {
    $sql = "SELECT `distanza_percorsa` FROM `bicicletta` WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_bicicletta);

    $stmt->execute();

    $km = 0;
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($result->num_rows == 1) {

        $km = $row["distanza_percorsa"];
    }

    $sql = "UPDATE `bicicletta` SET `distanza_percorsa`=? WHERE ID=$id_bicicletta";
    $stmt = $conn->prepare($sql);

    $km = $km + $distanza_percorsa;
    $stmt->bind_param("i", $km);

    $stmt->execute();
}

if ($id_user == 0) {
    $sql = "INSERT INTO `operazione`(`distanza_percorsa`, `tipo`, `tariffa`, `data_ora`, `id_cliente`,`id_bicicletta`, `id_stazione`) VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssddii", $operazione, $ora, $tariffa, $distanza_percorsa, $id_bicicletta, $id_stazione);
} else {
    $sql = "INSERT INTO `operazione`(`distanza_percorsa`, `tipo`, `tariffa`, `data_ora`, `id_cliente`,`id_bicicletta`, `id_stazione`) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssddiii", $operazione, $ora, $tariffa, $distanza_percorsa, $id_user, $id_bicicletta, $id_stazione);
}

if ($stmt->execute()) {
    $arr = array("status" => "ok", "message" => "operazione aggiunta");
    echo json_encode($arr);

} else {
    $arr = array("status" => "ko", "message" => "errore nell eseguzione");
    echo json_encode($arr);
}
?>