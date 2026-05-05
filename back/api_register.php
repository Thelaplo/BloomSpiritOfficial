<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') exit;

include_once('./modeles/ModeleUtilisateur.php');
include_once('./classes/Utilisateur.php');

$json = file_get_contents("php://input");
$data = json_decode($json, true);

if (isset($data['email']) && isset($data['password'])) {
    try {
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $user = new Utilisateur(
            $data['email'], 
            $hashedPassword, 
            false, // isAdmin par défaut à false
            $data['civilite'] ?? "Mme",
            $data['firstname'] ?? "",
            $data['lastname'] ?? "",
            $data['birthdate'] ?? "",
            $data['mobile'] ?? ""
        );

        ModeleUtilisateur::Insert($user);
        ob_clean(); // Nettoyage du tampon pour InfinityFree
        echo json_encode(["success" => true, "message" => "Compte créé avec succès !"]);

    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Données incomplètes"]);
}
?>