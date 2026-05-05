<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') exit;

include_once('./connexpdo.inc.php');

try {
    $cnx = connexpdo('if0_41488430_gestion_excursions', 'myparam');

    $resUsers = $cnx->query("SELECT COUNT(*) FROM Utilisateur");
    $usersCount = (int)$resUsers->fetchColumn();

    $resExcu = $cnx->query("SELECT COUNT(*) FROM Excursion");
    $excuCount = (int)$resExcu->fetchColumn();

    $resFavTotal = $cnx->query("SELECT COUNT(*) FROM Favoris");
    $totalFav = (int)$resFavTotal->fetchColumn();

    $resTop = $cnx->query("SELECT E.nom, COUNT(F.idExcursion) as nb_fav 
                           FROM Excursion E
                           LEFT JOIN Favoris F ON E.id = F.idExcursion
                           GROUP BY E.id, E.nom 
                           ORDER BY nb_fav DESC 
                           LIMIT 3");
    $topFav = $resTop->fetchAll(PDO::FETCH_ASSOC);

    ob_clean();
    echo json_encode([
        "usersCount" => $usersCount,
        "totalExcursions" => $excuCount,
        "totalFavorites" => $totalFav,
        "topFavorites" => $topFav
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}