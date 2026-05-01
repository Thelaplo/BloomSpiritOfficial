<?php
    include_once('./classes/Etape.php');
    include_once('./connexpdo.inc.php');
    include_once('./modeles/ModeleLieu.php');
    include_once('./modeles/ModeleHebergement.php');

    class ModeleEtape
    {

    public static function SelectAll() : array
    {
        try{
        $Etapes = array();
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="SELECT * FROM Etape";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['numOrdre'];
                $lib = $uneLigne['description'];
                $duree = $uneLigne['dureeEst'];
                $lieu = ModeleLieu::SelectById($uneLigne['idLieu']);
                $hebergement = ModeleHebergement::SelectById($uneLigne['idHebergement']);
                $etape = new Etape($id,$lib,$duree,$lieu,$hebergement);
                array_push($Etapes,$etape);
            }
        $requete->closeCursor();
        $cnx=null;
        return $Etapes;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function SelectById(int $id, int $id2) : Etape
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="SELECT * FROM Etape WHERE idExcursion = :id AND numOrdre = :id2";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $requete->BindParam(':id2',$id2,PDO::PARAM_STR);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['numOrdre'];
                $lib = $uneLigne['description'];
                $duree = $uneLigne['description'];
                $lieu = ModeleLieu::SelectById($uneLigne['idLieu']);
                $hebergement = ModeleHebergement::SelectById($uneLigne['idHebergement']);
                $etape = new Etape($id,$lib,$duree,$lieu,$hebergement);
            }
        $requete->closeCursor();
        $cnx=null;
        return $etape;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function SelectEtapeByIdExcursion(int $id) : array
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="SELECT * FROM Etape ET INNER JOIN EXCURSION EX ON ET.idExcursion = EX.id WHERE EX.id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->bindParam(":id",$id,PDO::PARAM_INT);
        $result=$requete->execute();
        $lesTypes = array();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
        {
            $id = $uneLigne['numOrdre'];
            $lib = $uneLigne['description'];
            $duree = $uneLigne['dureeEst'];
            $lieu = ModeleLieu::SelectById($uneLigne['idLieu']);
            $hebergement = ModeleHebergement::SelectById($uneLigne['idHebergement']);
            $etape = new Etape($id,$lib,$duree,$lieu,$hebergement);
            array_push($lesTypes,$etape);
        }
        return $lesTypes;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function DeleteById(int $id, int $id2) : void
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="DELETE FROM Etape WHERE idExcursion = :id AND numOrdre = :id2";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':idExcursion',$id,PDO::PARAM_INT);
        $requete->BindParam(':numOrdre',$id,PDO::PARAM_INt);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function Update(Etape $Etape) : void
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="UPDATE Etape SET numOrdre = :id, commentaire = :lib, dureeEst = :duree, idLieu = :idLieu, idHebergement = :idHebergement WHERE numOrdre = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$Etape->GetNumero(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$Etape->GetDesc(),PDO::PARAM_STR);
        $requete->BindParam(':duree',$Etape->GetDesc(),PDO::PARAM_INT);
        $requete->BindParam(':idLieu',$Etape->GetLieu()->GetId(),PDO::PARAM_INT);
        $requete->BindParam(':idHebergement',$Etape->GetHebergement()->GetId(),PDO::PARAM_INT);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function Insert(Etape $Etape) : void
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="INSERT INTO Etape (numOrdre,commentaire,dureeEst,idLieu,idHebergemnt) VALUES (:id,:lib,:duree,:idLieu,:idHebergement)";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$Etape->GetNumero(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$Etape->GetDesc(),PDO::PARAM_STR);
        $requete->BindParam(':duree',$Etape->GetDesc(),PDO::PARAM_INT);
        $requete->BindParam(':idLieu',$Etape->GetLieu()->GetId(),PDO::PARAM_INT);
        $requete->BindParam(':idHebergement',$Etape->GetHebergement()->GetId(),PDO::PARAM_INT);
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