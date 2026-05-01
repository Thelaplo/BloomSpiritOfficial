<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once('./modeles/ModeleExcursion.php');
include_once('./modeles/ModeleCategorieExcursion.php');
include_once('./classes/Excursion.php');

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    try {
        // 1. Récupérer l'objet catégorie (besoin pour le constructeur d'Excursion)
        $categorie = ModeleCategorieExcursion::SelectById($data['idCat']);
        
        // 2. Créer un ID unique (ex: EX_12345) si ton champ ID n'est pas en auto-increment
        $newId = "EX_" . time(); 

        // 3. Créer l'objet Excursion
        $newExcu = new Excursion(
            $newId,
            $data['nom'],
            $data['image'],
            $data['desc'],
            (int)$data['duree'],
            $data['difficulte'],
            (int)$data['nbLimitPers'],
            (float)$data['prix'],
            $categorie
        );

        // 4. Appeler le modèle
        ModeleExcursion::Insert($newExcu);
        
        echo json_encode(["success" => true, "message" => "Excursion créée !"]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}
?>