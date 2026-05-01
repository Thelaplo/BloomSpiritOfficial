<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
include_once('./modeles/ModeleExcursion.php');

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        ModeleExcursion::DeleteById($id); // Utilise ta méthode existante
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}
?>