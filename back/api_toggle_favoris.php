<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') exit;

include_once('./modeles/ModeleFavoris.php');
include_once('./connexpdo.inc.php');

$data = json_decode(file_get_contents("php://input"), true);
$login = $data['login'] ?? null;
$idExcu = $data['idExcursion'] ?? null;

if ($login && $idExcu) {
    try {
        ob_clean();
        if (ModeleFavoris::Exists($login, $idExcu)) {
            ModeleFavoris::Delete($login, $idExcu);
            echo json_encode(["status" => "removed", "message" => "Retiré des favoris"]);
        } else {
            ModeleFavoris::Insert($login, $idExcu);
            echo json_encode(["status" => "added", "message" => "Ajouté aux favoris"]);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Données login ou idExcursion manquantes"]);
}
?>