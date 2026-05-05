<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') exit;

include_once('./connexpdo.inc.php');
include_once('./modeles/ModeleFavoris.php');

$login = $_GET['login'] ?? null;
$idExcursion = isset($_GET['idExcursion']) ? (int)$_GET['idExcursion'] : null;

ob_clean();
if ($login && $idExcursion) {
    $exists = ModeleFavoris::Exists($login, $idExcursion);
    echo json_encode(["isFavorite" => $exists]);
} else {
    echo json_encode(["isFavorite" => false]);
}