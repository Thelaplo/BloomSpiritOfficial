<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
include_once('./connexpdo.inc.php');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['login']) && isset($data['password'])) {
    try {
        $cnx = connexpdo('gestion_excursions', 'myparam');
        $stmt = $cnx->prepare("SELECT login, mdp, IsAdmin FROM Utilisateur WHERE login = :login");
        $stmt->execute([':login' => $data['login']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($data['password'], $user['mdp'])) {
            echo json_encode([
                "success" => true,
                "user" => [
                    "login" => $user['login'], 
                    "isAdmin" => (bool)$user['IsAdmin']
                ]
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Identifiants incorrects"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}
?>