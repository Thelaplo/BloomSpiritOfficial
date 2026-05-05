<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once('./connexpdo.inc.php');

$login = $_GET['login'] ?? null;

if ($login) {
    try {
        $cnx = connexpdo('if0_41488430_gestion_excursions', 'myparam');
        $stmt = $cnx->prepare("SELECT E.* FROM Excursion E INNER JOIN Favoris F ON E.id = F.idExcursion WHERE F.login = :login");
        $stmt->execute([':login' => $login]);
        ob_clean();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode([]);
}