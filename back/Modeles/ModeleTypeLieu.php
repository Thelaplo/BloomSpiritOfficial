<?php

    include('./classes/TypeLieu.php');
    include_once('./connexpdo.inc.php');

    class ModeleTypeLieu
    {

    public static function SelectAll() : array
    {
        $typeLieu = array();
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM TypeLieu";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['lib'];
                $typeLi = new TypeLieu($id,$lib);
                array_push($typeLieu,$typeLi);
            }
        $requete->closeCursor();
        $cnx=null;
        return $typeLieu;
    }

    public static function SelectById(string $id) : TypeLieu
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
                $typeLi = new TypeLieu($id,$lib);
            }
        $requete->closeCursor();
        $cnx=null;
        return $typeLi;
    }

    public static function DeleteById(string $id) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="DELETE FROM TypeLieu WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
    }

    public static function Update(TypeLieu $typeLieu) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="UPDATE TypeLieu SET id = :id, lib = :lib WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$typeLieu->GetId(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$typeLieu->GetLib(),PDO::PARAM_STR);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
    }

    public static function Insert(TypeLieu $typeLieu) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="INSERT INTO TypeLieu VALUES (:id,:lib)";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$typeLieu->GetId(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$typeLieu->GetLib(),PDO::PARAM_STR);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
    }

}

?>