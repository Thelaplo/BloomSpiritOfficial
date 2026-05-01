<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once('./connexpdo.inc.php');

$login = $_GET['login'] ?? null;

if ($login) {
    try {
        $cnx = connexpdo('gestion_excursions', 'myparam');
        // On récupère les excursions liées aux favoris de l'utilisateur
        $query = "SELECT E.* FROM Excursion E 
                  INNER JOIN Favoris F ON E.id = F.idExcursion 
                  WHERE F.login = :login";
        
        $stmt = $cnx->prepare($query);
        $stmt->bindValue(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
        
        $favoris = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($favoris);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode([]);
}
?>