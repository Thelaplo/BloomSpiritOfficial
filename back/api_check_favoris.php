<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once('./connexpdo.inc.php');
include_once('./modeles/ModeleFavoris.php');

$login = $_GET['login'] ?? null;
// On force la conversion en entier
$idExcursion = isset($_GET['idExcursion']) ? (int)$_GET['idExcursion'] : null;

if ($login && $idExcursion) {
    $exists = ModeleFavoris::Exists($login, $idExcursion);
    echo json_encode(["isFavorite" => $exists]);
} else {
    echo json_encode(["isFavorite" => false]);
}