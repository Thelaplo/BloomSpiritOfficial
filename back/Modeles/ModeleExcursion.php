<?php
    include('./classes/Excursion.php');
    include_once('./connexpdo.inc.php');
    class ModeleExcursion
    {

    public static function SelectAll() : array
    {
        $categorie = array();
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Excursion";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['nom'];
                $com = $uneLigne['commentaire'];
                $duree = $uneLigne['duree'];
                $dif = $uneLigne['difficulte'];
                $nbPers = $uneLigne['nbLimitPers'];
                $prix = $uneLigne['prix'];
                $idCat = ModeleCategorieExcursion::SelectById($uneLigne['idTypeExcursion']);
                $typeTransports = ModeleTypeTransport::SelectById($uneLigne['idTypeExcursion']);
                $etapes = ModeleEtape::SelectEtapeByIdExcursio($uneLigne['idTypeExcursion']);
                $cat = new Excursion($id,$lib,$com,$duree,$dif,$nbPers,$prix,$idCat);
                array_push($categorie,$cat);
            }
        $requete->closeCursor();
        $cnx=null;
        return $categorie;
    }

    public static function SelectById(string $id) : Excursion
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Excursion WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['nom'];
                $com = $uneLigne['commentaire'];
                $duree = $uneLigne['duree'];
                $dif = $uneLigne['difficulte'];
                $nbPers = $uneLigne['nbLimitPers'];
                $prix = $uneLigne['prix'];
                $idCat = ModeleCategorieExcursion::SelectById($uneLigne['idTypeExcursion']);
                $typeTransports = ModeleTypeTransport::SelectById($uneLigne['idTypeExcursion']);
                $etapes = ModeleEtape::SelectEtapeByIdExcursio($uneLigne['idTypeExcursion']);
                $cat = new Excursion($id,$lib,$com,$lat,$long,$note,$img,$typeExcursion);
            }
        $requete->closeCursor();
        $cnx=null;
        return $cat;
    }

    public static function DeleteByIdExcursion(int $id) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="DELETE FROM Excursion WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
    }

    public static function UpdateExcursion(Excursion $categorie) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="UPDATE Excursion SET id = :id, nom = :lib, commentaire = :com, latitude = CONVERT(:lat, DECIMAL), longitude = CONVERT(:long, DECIMAL), note = CONVERT(:note, DECIMAL), image = :img, idTypeExcursion = :idTypeExcursion WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$categorie->GetId(),PDO::PARAM_INT);
        $requete->BindParam(':lib',$categorie->GetNom(),PDO::PARAM_STR);
        $requete->BindParam(':com',$categorie->GetDesc(),PDO::PARAM_STR);
        $requete->BindParam(':lat',(string)$categorie->GetLatitude(),PDO::PARAM_STR);
        $requete->BindParam(':long',(string)$categorie->GetLongitude(),PDO::PARAM_STR);
        $requete->BindParam(':note',(string)$categorie->GetNote(),PDO::PARAM_STR);
        $requete->BindParam(':img',$categorie->GetImg(),PDO::PARAM_STR);
        $requete->BindParam(':com',$categorie->GetTypeExcursion()->GetId(),PDO::PARAM_INT);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
    }

    public static function InsertExcursion(Excursion $categorie) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="INSERT INTO Excursion VALUES (:id, :lib, :com, CONVERT(:lat, DECIMAL), CONVERT(:long, DECIMAL), CONVERT(:note, DECIMAL), :img, :idTypeExcursion)";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$categorie->GetId(),PDO::PARAM_INT);
        $requete->BindParam(':lib',$categorie->GetNom(),PDO::PARAM_STR);
        $requete->BindParam(':com',$categorie->GetDesc(),PDO::PARAM_STR);
        $requete->BindParam(':lat',(string)$categorie->GetLatitude(),PDO::PARAM_STR);
        $requete->BindParam(':long',(string)$categorie->GetLongitude(),PDO::PARAM_STR);
        $requete->BindParam(':note',(string)$categorie->GetNote(),PDO::PARAM_STR);
        $requete->BindParam(':img',$categorie->GetImg(),PDO::PARAM_STR);
        $requete->BindParam(':com',$categorie->GetTypeExcursion()->GetId(),PDO::PARAM_INT);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
    }
    

}

?>