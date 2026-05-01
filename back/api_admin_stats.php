<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('./connexpdo.inc.php');

try {
    // Connexion à ta base (vérifie bien le nom 'gestion_excursions' et 'myparam')
    $cnx = connexpdo('gestion_excursions', 'myparam');

    // 1. Compter les utilisateurs (Voyageurs)
    $resUsers = $cnx->query("SELECT COUNT(*) FROM Utilisateur");
    $usersCount = (int)$resUsers->fetchColumn();

    // 2. Compter le total des excursions (Destinations)
    $resExcu = $cnx->query("SELECT COUNT(*) FROM Excursion");
    $excuCount = (int)$resExcu->fetchColumn();

    // 3. Compter le total des favoris distribués
    $resFavTotal = $cnx->query("SELECT COUNT(*) FROM Favoris");
    $totalFav = (int)$resFavTotal->fetchColumn();

    // 4. Récupérer le Top 3 des excursions les plus aimées
    // On joint la table Excursion et Favoris pour avoir les noms
    $resTop = $cnx->query("SELECT E.nom, COUNT(F.idExcursion) as nb_fav 
                           FROM Excursion E
                           LEFT JOIN Favoris F ON E.id = F.idExcursion
                           GROUP BY E.id, E.nom 
                           ORDER BY nb_fav DESC 
                           LIMIT 3");
    $topFav = $resTop->fetchAll(PDO::FETCH_ASSOC);

    // On renvoie tout proprement en JSON
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
?>