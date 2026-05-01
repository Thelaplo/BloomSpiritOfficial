<?php

    include_once('./classes/TypeLieu.php');
    include_once('./connexpdo.inc.php');

    class ModeleTypeLieu
    {

    public static function SelectAll() : array
    {
        try{
        $typeLieu = array();
        $cnx=connexpdo('gestion_excursions','myparam');
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
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function SelectById(string $id) : TypeLieu
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
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
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function DeleteById(string $id) : void
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="DELETE FROM TypeLieu WHERE id = :id";
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

    public static function Update(TypeLieu $typeLieu) : void
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="UPDATE TypeLieu SET id = :id, lib = :lib WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$typeLieu->GetId(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$typeLieu->GetLib(),PDO::PARAM_STR);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function Insert(TypeLieu $typeLieu) : void
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="INSERT INTO TypeLieu VALUES (:id,:lib)";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$typeLieu->GetId(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$typeLieu->GetLib(),PDO::PARAM_STR);
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