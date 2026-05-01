<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('./modeles/ModeleUtilisateur.php');

try {
    $liste = ModeleUtilisateur::SelectAll();
    $resultat = [];

    foreach ($liste as $user) {
        $resultat[] = [
            "login" => $user->GetLogin(),
            "isAdmin" => $user->GetIsAdmin()
        ];
    }
    echo json_encode($resultat);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>