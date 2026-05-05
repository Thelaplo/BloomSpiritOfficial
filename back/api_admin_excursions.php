<?php
// 1. Autoriser Vercel à appeler cette API (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

// Si c'est une requête de vérification (OPTIONS), on stop ici
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

include_once('./modeles/ModeleExcursion.php');

try {
    $liste = ModeleExcursion::SelectAll();
    $resultat = [];

    if ($liste) {
        foreach ($liste as $excu) {
            $resultat[] = [
                "id" => $excu->GetId(),
                "name" => strtoupper($excu->GetNom()),
                "color" => "hsl(" . rand(0, 360) . ", 30%, 75%)" 
            ];
        }
    }
    
    // On vide le tampon de sortie pour être sûr qu'il n'y a que du JSON
    ob_clean(); 
    echo json_encode($resultat);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
exit; // Sécurité pour éviter que du texte s'ajoute après le JSON