<?php
include_once('./connexpdo.inc.php');

class ModeleFavoris 
{
    /**
     * Ajoute un favori en base de données
     */
    public static function Insert(string $login, int $idExcursion) : void
    {
        try {
            $cnx = connexpdo('gestion_excursions', 'myparam');
            $reqChaine = "INSERT INTO Favoris (login, idExcursion) VALUES (:login, :idExcu)";
            $requete = $cnx->prepare($reqChaine);
            
            // On utilise bindValue car ce sont des valeurs directes
            $requete->bindValue(':login', $login, PDO::PARAM_STR);
            $requete->bindValue(':idExcu', $idExcursion, PDO::PARAM_INT);
            
            $requete->execute();
            $cnx = null;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout du favori : " . $e->getMessage());
        }
    }

    /**
     * Supprime un favori
     */
    public static function Delete(string $login, int $idExcursion) : void
    {
        try {
            $cnx = connexpdo('gestion_excursions', 'myparam');
            $reqChaine = "DELETE FROM Favoris WHERE login = :login AND idExcursion = :idExcu";
            $requete = $cnx->prepare($reqChaine);
            
            $requete->bindValue(':login', $login, PDO::PARAM_STR);
            $requete->bindValue(':idExcu', $idExcursion, PDO::PARAM_INT);
            
            $requete->execute();
            $cnx = null;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression du favori : " . $e->getMessage());
        }
    }

    /**
     * Vérifie si un favori existe déjà pour cet utilisateur
     */
    public static function Exists(string $login, int $idExcursion) : bool
    {
        $cnx = connexpdo('gestion_excursions', 'myparam');
        $requete = $cnx->prepare("SELECT COUNT(*) FROM Favoris WHERE login = :login AND idExcursion = :idExcu");
        $requete->bindValue(':login', $login, PDO::PARAM_STR);
        $requete->bindValue(':idExcu', $idExcursion, PDO::PARAM_INT);
        $requete->execute();
        
        return (int)$requete->fetchColumn() > 0;
    }
}
?>