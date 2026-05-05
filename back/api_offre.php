<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('./classes/Excursion.php');
include_once('./modeles/ModeleExcursion.php');

try {
    $all = ModeleExcursion::SelectAll();
    $typesOffres = [
        ["tag" => "Promotion", "badge" => "-15%", "promo" => "Réduction immédiate"],
        ["tag" => "Exclusif", "badge" => "Activité", "promo" => "Pass Musées offert"]
    ];
    $offres = [];
    foreach (array_slice($all, 0, 3) as $index => $excu) {
        $info = $typesOffres[$index % count($typesOffres)];
        $offres[] = [
            "id" => $excu->GetId(),
            "title" => $excu->GetNom(),
            "image" => "/img/" . $excu->GetImage(),
            "tag" => $info["tag"],
            "badge" => $info["badge"],
            "promo" => $info["promo"]
        ];
    }
    ob_clean();
    echo json_encode($offres);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}