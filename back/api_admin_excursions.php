<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
include_once('./modeles/ModeleExcursion.php');

try {
    $liste = ModeleExcursion::SelectAll();
    $resultat = [];

    foreach ($liste as $excu) {
        $resultat[] = [
            "id" => $excu->GetId(),
            "name" => strtoupper($excu->GetNom()),
            // On génère une couleur aléatoire douce si tu n'en as pas en DB
            "color" => "hsl(" . rand(0, 360) . ", 30%, 75%)" 
        ];
    }
    echo json_encode($resultat);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}