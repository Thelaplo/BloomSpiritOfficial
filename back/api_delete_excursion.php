<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, GET, OPTIONS");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') exit;

include_once('./modeles/ModeleExcursion.php');
$id = $_GET['id'] ?? null;

if ($id) {
    try {
        ModeleExcursion::DeleteById($id);
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}