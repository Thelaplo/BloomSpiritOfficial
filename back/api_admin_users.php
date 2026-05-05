<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') exit;

include_once('./modeles/ModeleUtilisateur.php');

try {
    $liste = ModeleUtilisateur::SelectAll();
    $resultat = [];
    foreach ($liste as $user) {
        $resultat[] = [
            "login" => $user->GetLogin(),
            "isAdmin" => (bool)$user->GetIsAdmin()
        ];
    }
    ob_clean();
    echo json_encode($resultat);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}