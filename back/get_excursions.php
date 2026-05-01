<?php
// Autoriser l'accès depuis ton serveur Vue.js (Vite)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("connexpdo.inc.php");

// Configuration de la connexion
$base = "gestion_excursions";
$param = "myparam"; // Référence à ton fichier myparam.inc.php

try {
    $cnx = connexpdo($base, $param);

    // Requête pour récupérer toutes les excursions avec leurs catégories
    // On sélectionne la nouvelle colonne 'image' qu'on a ajoutée
    $sql = "SELECT e.*, c.lib as categorie_nom 
            FROM Excursion e
            INNER JOIN Categorie c ON e.idCat = c.id
            ORDER BY e.id ASC";

    $stmt = $cnx->prepare($sql);
    $stmt->execute();

    $excursions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Envoyer les données au format JSON
    echo json_encode($excursions);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erreur de base de données : " . $e->getMessage()]);
}
?>