<?php
    include_once('./classes/Lieu.php');
    include_once('./connexpdo.inc.php');
    include_once('Modeles/ModeleTypeLieu.php');

    class ModeleLieu
    {

    public static function SelectAll() : array
    {
        try{
        $lieu = array();
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Lieu";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['nom'];
                $com = $uneLigne['commentaire'];
                $lat = $uneLigne['latitude'];
                $long = $uneLigne['longitude'];
                $note = $uneLigne['note'];
                $img = $uneLigne['image'];
                $typeLieu = ModeleTypeLieu::SelectById($uneLigne['idTypeLieu']);
                $li = new Lieu($id,$lib,$com,$lat,$long,$note,$img,$typeLieu);
                array_push($lieu,$li);
            }
        $requete->closeCursor();
        $cnx=null;
        return $lieu;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function SelectById(string $id) : Lieu
    {
        try{
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Lieu WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['nom'];
                $com = $uneLigne['commentaire'];
                $lat = $uneLigne['latitude'];
                $long = $uneLigne['longitude'];
                $note = $uneLigne['note'];
                $img = $uneLigne['image'];
                $typeLieu = ModeleTypeLieu::SelectById($uneLigne['idTypeLieu']);
                $li = new Lieu($id,$lib,$com,$lat,$long,$note,$img,$typeLieu);
            }
        $requete->closeCursor();
        $cnx=null;
        return $li;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function SelectByIdEtape(int $id, int $id2) : array
    {
        try{
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Lieu LI INNER JOIN ETAPE ET ON ET.idLieu = LI.id WHERE ET.idExcursion = :id AND ET.numOrdre = :id2";
        $requete=$cnx->prepare($reqChaine);
        $requete->bindParam(":id",$id,PDO::PARAM_INT);
        $requete->bindParam(":id2",$id2,PDO::PARAM_INT);
        $result=$requete->execute();
        $lesTypes = array();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
        {
            $id = $uneLigne['numOrdre'];
            $lib = $uneLigne['commentaire'];
            $duree = $uneLigne['commentaire'];
            $lieu = ModeleLieu::SelectByIdLieu($uneLigne['idLieu']);
            $hebergement = ModeleLieu::SelectByIdHebergement($uneLigne['idHebergement']);
            $etape = new Etape($id,$lib,$duree,$lieu,$hebergement);
            array_push($lesTypes,$etape);
        }
        return $lesTypes;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function DeleteById(int $id) : void
    {
        try{
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="DELETE FROM Lieu WHERE id = :id";
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

    public static function Update(Lieu $lieu) : void
    {
        try{
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="UPDATE Lieu SET id = :id, nom = :lib, commentaire = :com, latitude = CONVERT(:lat, DECIMAL), longitude = CONVERT(:long, DECIMAL), note = CONVERT(:note, DECIMAL), image = :img, idTypeLieu = :idTypeLieu WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$lieu->GetId(),PDO::PARAM_INT);
        $requete->BindParam(':lib',$lieu->GetNom(),PDO::PARAM_STR);
        $requete->BindParam(':com',$lieu->GetDesc(),PDO::PARAM_STR);
        $requete->BindParam(':lat',(string)$lieu->GetLatitude(),PDO::PARAM_STR);
        $requete->BindParam(':long',(string)$lieu->GetLongitude(),PDO::PARAM_STR);
        $requete->BindParam(':note',(string)$lieu->GetNote(),PDO::PARAM_STR);
        $requete->BindParam(':img',$lieu->GetImg(),PDO::PARAM_STR);
        $requete->BindParam(':com',$lieu->GetTypeLieu()->GetId(),PDO::PARAM_INT);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function Insert(Lieu $lieu) : void
    {
        try{
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="INSERT INTO Lieu VALUES (:id, :lib, :com, CONVERT(:lat, DECIMAL), CONVERT(:long, DECIMAL), CONVERT(:note, DECIMAL), :img, :idTypeLieu)";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$lieu->GetId(),PDO::PARAM_INT);
        $requete->BindParam(':lib',$lieu->GetNom(),PDO::PARAM_STR);
        $requete->BindParam(':com',$lieu->GetDesc(),PDO::PARAM_STR);
        $requete->BindParam(':lat',(string)$lieu->GetLatitude(),PDO::PARAM_STR);
        $requete->BindParam(':long',(string)$lieu->GetLongitude(),PDO::PARAM_STR);
        $requete->BindParam(':note',(string)$lieu->GetNote(),PDO::PARAM_STR);
        $requete->BindParam(':img',$lieu->GetImg(),PDO::PARAM_STR);
        $requete->BindParam(':com',$lieu->GetTypeLieu()->GetId(),PDO::PARAM_INT);
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