<?php
    include('./classes/Lieu.php');
    include_once('./connexpdo.inc.php');
    include_once('Modeles/ModeleTypeLieu.php');

    class ModeleLieu
    {

    public static function SelectAll() : array
    {
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
                $img = $uneLigne['img'];
                $typeLieu = ModeleTypeLieu::SelectByIdTypeLieu($uneLigne['idTypeLieu']);
                $li = new Lieu($id,$lib,$com,$lat,$long,$note,$img,$typeLieu);
                array_push($lieu,$li);
            }
        $requete->closeCursor();
        $cnx=null;
        return $lieu;
    }

    public static function SelectById(string $id) : Lieu
    {
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
                $img = $uneLigne['img'];
                $typeLieu = ModeleTypeLieu::SelectByIdTypeLieu($uneLigne['idTypeLieu']);
                $li = new Lieu($id,$lib,$com,$lat,$long,$note,$img,$typeLieu);
            }
        $requete->closeCursor();
        $cnx=null;
        return $li;
    }

    public static function DeleteById(int $id) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="DELETE FROM Lieu WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
    }

    public static function Update(Lieu $lieu) : void
    {
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
    }

    public static function Insert(Lieu $lieu) : void
    {
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
    }

}

?>