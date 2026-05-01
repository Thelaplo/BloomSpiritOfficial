<?php
    include_once('./classes/Excursion.php');
    include_once('./connexpdo.inc.php');
    include_once('./modeles/ModeleCategorieExcursion.php');
    include_once('./modeles/ModeleTypeTransport.php');
    include_once('./modeles/ModeleEtape.php');
    class ModeleExcursion
    {

   public static function SelectAll() : array {
    try {
        $excursion = array();
        $cnx = connexpdo('gestion_excursions', 'myparam'); 
        $reqChaine = "SELECT * FROM Excursion";
        $requete = $cnx->prepare($reqChaine);
        $result = $requete->execute();
        
        while($uneLigne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $id = $uneLigne['id'];
            $lib = $uneLigne['nom'];
            $img = $uneLigne['image'];
            $com = $uneLigne['description'];
            $duree = $uneLigne['duree'];
            $dif = $uneLigne['difficulte'];
            $nbPers = $uneLigne['nbLimitPers'];
            $prix = (float)$uneLigne['prix'];
            $idCat = ModeleCategorieExcursion::SelectById($uneLigne['idCat']);
            
            // L'ordre doit correspondre au constructeur : id, nom, image, desc, duree, dif, nbPers, prix, categorie
            $excu = new Excursion($id, $lib, $img, $com, $duree, $dif, $nbPers, $prix, $idCat);
            array_push($excursion, $excu);
        }
        $requete->closeCursor();
        $cnx=null;
        return $excursion;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function SelectById(string $id) : Excursion
{
    try {
        $cnx = connexpdo('gestion_excursions', 'myparam');
        $reqChaine = "SELECT * FROM Excursion WHERE id = :id";
        $requete = $cnx->prepare($reqChaine);
        $requete->bindParam(':id', $id, PDO::PARAM_STR); 
        $requete->execute();
        
        $excu = null;
        if ($uneLigne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $idExcu = $uneLigne['id'];
            $lib = $uneLigne['nom'];
            $img = $uneLigne['image'];
            $com = $uneLigne['description']; // Assure-toi que c'est bien 'description' en DB
            $duree = $uneLigne['duree'];
            $dif = $uneLigne['difficulte'];
            $nbPers = $uneLigne['nbLimitPers'];
            $prix = (float)$uneLigne['prix'];

            // Correction des appels de modèles ici :
            $categorie = ModeleCategorieExcursion::SelectById($uneLigne['idCat']); 
            
            // Création de l'objet
            $excu = new Excursion($idExcu, $lib, $img, $com, $duree, $dif, $nbPers, $prix, $categorie);

            // Chargement des données liées (Transport et Étapes)
            $typeTransports = ModeleTypeTransport::SelectTransportByIdExcursion($idExcu);
            $etapes = ModeleEtape::SelectEtapeByIdExcursion($idExcu);
            
            $excu->SetTypeTransport($typeTransports);
            $excu->SetEtapes($etapes);
        }

        $requete->closeCursor();
        $cnx = null;
        return $excu;

    } catch(PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
}

    public static function DeleteById(int $id) : void
    {
        try{
        $cnx = connexpdo('gestion_excursions','myparam');
        $reqChaine = "DELETE FROM Excursion WHERE id = :id";
        $requete = $cnx->prepare($reqChaine);
        $requete->bindParam(':id', $id, PDO::PARAM_STR); // Correction typo bindParam
        $requete->execute();
        $requete->closeCursor();
        $cnx = null;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function Insert(Excursion $excursion) : void
    {
        try {
            $cnx = connexpdo('gestion_excursions', 'myparam');
            // Correction : Ajout de la parenthèse fermante et de la colonne 'image' oubliée dans ton SQL
            $reqChaine = "INSERT INTO Excursion (id, nom, image, description, duree, difficulte, nbLimitPers, prix, idCat) 
                          VALUES (:id, :nom, :img, :com, :duree, :dif, :lim, :prix, :idCat)";
            
            $requete = $cnx->prepare($reqChaine);
            
            // Correction : Remplacement de :lib par :nom et :img ajouté
            $requete->bindParam(':id', $excursion->GetId(), PDO::PARAM_STR);
            $requete->bindParam(':nom', $excursion->GetNom(), PDO::PARAM_STR);
            $requete->bindParam(':img', $excursion->GetImage(), PDO::PARAM_STR);
            $requete->bindParam(':com', $excursion->GetDesc(), PDO::PARAM_STR);
            $requete->bindParam(':duree', $excursion->GetDuree(), PDO::PARAM_INT);
            $requete->bindParam(':dif', $excursion->GetDifficulte(), PDO::PARAM_STR);
            $requete->bindParam(':lim', $excursion->GetNbLimitPers(), PDO::PARAM_INT);
            $requete->bindParam(':prix', $excursion->GetPrix());
            $requete->bindParam(':idCat', $excursion->GetCategorie()->GetId(), PDO::PARAM_STR);
            
            $requete->execute();                   
            $requete->closeCursor();
            $cnx = null;
        } catch(PDOException $e) {
            throw new Exception("Erreur SQL Insert : " . $e->getMessage());
        }
    }

    public static function Update(Excursion $excursion) : void
    {
        try {
            $cnx = connexpdo('gestion_excursions', 'myparam');
            // Correction : Harmonisation des noms de paramètres (:lib -> :nom)
            $reqChaine = "UPDATE Excursion SET nom = :nom, image = :img, description = :com, duree = :duree, 
                          difficulte = :dif, nbLimitPers = :lim, prix = :prix, idCat = :idCat WHERE id = :id";
            
            $requete = $cnx->prepare($reqChaine);
            
            $requete->bindParam(':id', $excursion->GetId(), PDO::PARAM_STR);
            $requete->bindParam(':nom', $excursion->GetNom(), PDO::PARAM_STR);
            $requete->bindParam(':img', $excursion->GetImage(), PDO::PARAM_STR);
            $requete->bindParam(':com', $excursion->GetDesc(), PDO::PARAM_STR);
            $requete->bindParam(':duree', $excursion->GetDuree(), PDO::PARAM_INT);
            $requete->bindParam(':dif', $excursion->GetDifficulte(), PDO::PARAM_STR);
            $requete->bindParam(':lim', $excursion->GetNbLimitPers(), PDO::PARAM_INT);
            $requete->bindParam(':prix', $excursion->GetPrix());
            $requete->bindParam(':idCat', $excursion->GetCategorie()->GetId(), PDO::PARAM_STR);
            
            $requete->execute();                   
            $requete->closeCursor();
            $cnx = null;
        } catch(PDOException $e) {
            throw new Exception("Erreur SQL Update : " . $e->getMessage());
        }
    }
    

}

?>