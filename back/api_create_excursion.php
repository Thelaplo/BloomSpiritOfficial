<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') exit;

include_once('./modeles/ModeleExcursion.php');
include_once('./modeles/ModeleCategorieExcursion.php');
include_once('./classes/Excursion.php');

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    try {
        $categorie = ModeleCategorieExcursion::SelectById($data['idCat']);
        $newId = "EX_" . time(); 
        $newExcu = new Excursion(
            $newId, $data['nom'], $data['image'], $data['desc'],
            (int)$data['duree'], $data['difficulte'], (int)$data['nbLimitPers'],
            (float)$data['prix'], $categorie
        );
        ModeleExcursion::Insert($newExcu);
        echo json_encode(["success" => true, "message" => "Excursion créée !"]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}