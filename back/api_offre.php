<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('./classes/Excursion.php');
include_once('./modeles/ModeleExcursion.php');

try {
    $all = ModeleExcursion::SelectAll();
    $offres = [];

    // On définit des types d'offres différents
    $typesOffres = [
        ["tag" => "Promotion", "badge" => "-15%", "promo" => "Réduction immédiate"],
        ["tag" => "Exclusif", "badge" => "Activité", "promo" => "Pass Musées offert"],
        ["tag" => "Transport", "badge" => "Inclus", "promo" => "Japan Rail Pass 7j"],
        ["tag" => "Saison", "badge" => "Guide", "promo" => "Guide privé offert"]
    ];

    // On prend les 4 premières excursions pour en faire des offres variées
    foreach (array_slice($all, 0, 3) as $index => $excu) {
        $offreInfo = $typesOffres[$index % count($typesOffres)]; // Alterne les types d'offres
        
        $offres[] = [
            "id"    => $excu->GetId(),
            "title" => $excu->GetNom(),
            "image" => "/img/" . $excu->GetImage(),
            "tag"   => $offreInfo["tag"],
            "badge" => $offreInfo["badge"],
            "promo" => $offreInfo["promo"]
        ];
    }
    echo json_encode($offres);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>