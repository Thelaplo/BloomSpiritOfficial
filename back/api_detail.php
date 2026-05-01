<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// On garde tes inclusions actuelles
include_once('./classes/Excursion.php');
include_once('./modeles/ModeleExcursion.php');

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        // On récupère l'excursion via ton modèle existant
        $excu = ModeleExcursion::SelectById($id);
        
        $steps = [];
        // On boucle sur les étapes pour extraire les infos
        // Note : Ton modèle récupère déjà les étapes liées en SQL
        foreach ($excu->GetEtapes() as $etape) {
            $steps[] = [
                "day"   => $etape->GetNumero(), // Le numOrdre
                "label" => $etape->GetDesc(),   // La description de l'étape
                // Si ton objet Etape a une méthode pour le lieu, tu peux l'ajouter ici
            ];
        }

        // On prépare la réponse JSON attendue par DetailView.vue
        $data = [
            "id"             => $excu->GetId(),
            "title"          => $excu->GetNom(),
            "imageUrl"       => "/img/" . $excu->GetImage(), // Chemin vers tes photos du Japon
            "description"    => $excu->GetDesc(),
            "duration"       => $excu->GetDuree(),
            "price"          => $excu->GetPrix(),
            "etapes"         => $steps, // Tes 6-7 étapes apparaîtront ici
            "mapImageUrl"    => "bloomSpirit/back/img/carte_zoom.png"
        ];
        
        echo json_encode($data);

    } catch (Exception $e) {
        http_response_code(404);
        echo json_encode(["error" => "Voyage non trouvé : " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "ID manquant"]);
}
?>