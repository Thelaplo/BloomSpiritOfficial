<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('./classes/Excursion.php');
include_once('./modeles/ModeleExcursion.php');

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $excu = ModeleExcursion::SelectById($id);
        $steps = [];
        foreach ($excu->GetEtapes() as $etape) {
            $steps[] = [
                "day"   => $etape->GetNumero(),
                "label" => $etape->GetDesc()
            ];
        }
        ob_clean();
        echo json_encode([
            "id" => $excu->GetId(),
            "title" => $excu->GetNom(),
            "imageUrl" => "/img/" . $excu->GetImage(),
            "description" => $excu->GetDesc(),
            "duration" => $excu->GetDuree(),
            "price" => $excu->GetPrix(),
            "etapes" => $steps,
            "mapImageUrl" => "bloomSpirit/back/img/carte_zoom.png"
        ]);
    } catch (Exception $e) {
        http_response_code(404);
        echo json_encode(["error" => $e->getMessage()]);
    }
}