<?php

    include('./classes/CategorieExcursion.php');
    include_once('./connexpdo.inc.php');

    class ModeleCategorieExcursion
    {

    public static function SelectAll() : array
    {
        $catExcursion = array();
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Categorie";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['lib'];
                $cat = new CategorieExcursion($id,$lib);
                array_push($catExcursion,$cat);
            }
        $requete->closeCursor();
        $cnx=null;
        return $catExcursion;
    }

    public static function SelectById(string $id) : CategorieExcursion
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Categorie WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['lib'];
                $cat = new CategorieExcursion($id,$lib);
            }
        $requete->closeCursor();
        $cnx=null;
        return $cat;
    }

    public static function DeleteById(string $id) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="DELETE FROM Categorie WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
    }

    public static function Update(CategorieExcusion $catExcursion) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="UPDATE Categorie SET id = :id, lib = :lib WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$catExcursion->GetId(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$catExcursion->GetLib(),PDO::PARAM_STR);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
    }

    public static function Insert(CategorieExcusion $catExcursion) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="INSERT INTO Categorie VALUES (:id,:lib)";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$catExcursion->GetId(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$catExcursion->GetLib(),PDO::PARAM_STR);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
    }

}

?>