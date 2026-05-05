<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('./classes/Excursion.php');
include_once('./modeles/ModeleExcursion.php');

try {
    $all = ModeleExcursion::SelectAll();
    $data = [];
    foreach (array_slice($all, 0, 6) as $excu) {
        $data[] = [
            "id"    => $excu->GetId(),
            "nom"   => $excu->GetNom(),
            "image" => $excu->GetImage(),
            "prix"  => $excu->GetPrix(),
            "duree" => $excu->GetDuree()
        ];
    }
    ob_clean();
    echo json_encode($data);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}