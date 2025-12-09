<?php

    include('./classes/TypeLieu.php');
    include_once('./connexpdo.inc.php');

    class ModeleTypeLieu
    {

    public static function SelectAllTypeLieu() : array
    {
        $categorie = array();
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM TypeLieu";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['lib'];
                $cat = new TypeLieu($id,$lib);
                array_push($categorie,$cat);
            }
        $requete->closeCursor();
        $cnx=null;
        return $categorie;
    }

    public static function SelectByIdTypeLieu(string $id) : TypeLieu
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM TypeLieu WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['lib'];
                $cat = new TypeLieu($id,$lib);
            }
        $requete->closeCursor();
        $cnx=null;
        return $cat;
    }

    public static function DeleteByIdTypeLieu(string $id) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="DELETE FROM TypeLieu WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
    }

    public static function UpdateTypeLieu(TypeLieu $categorie) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="UPDATE TypeLieu SET id = :id, lib = :lib WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$categorie->GetId(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$categorie->GetLib(),PDO::PARAM_STR);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
    }

    public static function InsertTypeLieu(TypeLieu $categorie) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="INSERT INTO TypeLieu VALUES (:id,:lib)";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$categorie->GetId(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$categorie->GetLib(),PDO::PARAM_STR);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
    }

}

?>