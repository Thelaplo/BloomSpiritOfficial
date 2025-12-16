<?php
    include_once('./classes/Excursion.php');
    include_once('./connexpdo.inc.php');
    include_once('./modeles/ModeleCategorieExcursion.php');
    include_once('./modeles/ModeleTypeTransport.php');
    include_once('./modeles/ModeleEtape.php');
    class ModeleExcursion
    {

    public static function SelectAll() : array
    {
        try{
        $excursion = array();
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
                $idCat = ModeleCategorieExcursion::SelectById($uneLigne['idCat']);
                $typeTransports = ModeleTypeTransport::SelectTransportByIdExcursion($uneLigne['id']);
                $etapes = ModeleEtape::SelectEtapeByIdExcursion($uneLigne['id']);
                $excu = new Excursion($id,$lib,$com,$duree,$dif,$nbPers,$prix,$idCat);
                array_push($excursion,$excu);
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
        try{
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
                $idCat = ModeleCategorieExcursion::SelectTransportByIdExcursion($uneLigne['idTypeExcursion']);
                $typeTransports = ModeleTypeTransport::SelectById($uneLigne['idTypeExcursion']);
                $etapes = ModeleEtape::SelectEtapeByIdExcursion($uneLigne['idTypeExcursion']);
                $excu = new Excursion($id,$lib,$com,$duree,$dif,$nbPers,$prix,$idCat);
            }
        $requete->closeCursor();
        $cnx=null;
        return $excu;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function DeleteById(int $id) : void
    {
        try{
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="DELETE FROM Excursion WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function Update(Excursion $excursion) : void
    {
        try{
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="UPDATE Excursion SET id = :id, nom = :nom, commentaire = :com, duree = :duree, difficulte = :dif, nbLimitPers = :lim, prix = CONVERT(:prix, DECIMAL), idCat = :idCat WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$excursion->GetId(),PDO::PARAM_INT);
        $requete->BindParam(':lib',$excursion->GetNom(),PDO::PARAM_STR);
        $requete->BindParam(':com',$excursion->GetDesc(),PDO::PARAM_STR);
        $requete->BindParam(':duree',(string)$excursion->GetDuree(),PDO::PARAM_INT);
        $requete->BindParam(':dif',(string)$excursion->GetDifficulte(),PDO::PARAM_STR);
        $requete->BindParam(':lim',(string)$excursion->GetNbLimitPers(),PDO::PARAM_STR);
        $requete->BindParam(':prix',$excursion->GetPrix(),PDO::PARAM_INT);
        $requete->BindParam(':idCat',$excursion->GetCategorie()->GetId(),PDO::PARAM_INT);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function Insert(Excursion $excursion) : void
    {
        try{
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="INSERT INTO Excursion VALUES (:id, :nom, :com, :duree, :dif, :lim, CONVERT(:prix, DECIMAL), :idCat";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$excursion->GetId(),PDO::PARAM_INT);
        $requete->BindParam(':lib',$excursion->GetNom(),PDO::PARAM_STR);
        $requete->BindParam(':com',$excursion->GetDesc(),PDO::PARAM_STR);
        $requete->BindParam(':duree',(string)$excursion->GetDuree(),PDO::PARAM_INT);
        $requete->BindParam(':dif',(string)$excursion->GetDifficulte(),PDO::PARAM_STR);
        $requete->BindParam(':lim',(string)$excursion->GetNbLimitPers(),PDO::PARAM_STR);
        $requete->BindParam(':prix',$excursion->GetPrix(),PDO::PARAM_INT);
        $requete->BindParam(':idCat',$excursion->GetCategorie()->GetId(),PDO::PARAM_INT);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    

}

?>