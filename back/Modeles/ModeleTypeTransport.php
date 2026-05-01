<?php

    include_once('./classes/TypeTransport.php');
    include_once('./connexpdo.inc.php');


    class ModeleTypeTransport
    {

    public static function SelectAll() : array
    {
        try{
        $transport = array();
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="SELECT * FROM TypeTransport";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['type'];
                $typeTransport = new TypeTransport($id,$lib);
                array_push($transport,$typeTransport);
            }
        $requete->closeCursor();
        $cnx=null;
        return $transport;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function SelectTransportByIdExcursion(int $id) : array
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="SELECT * FROM TypeTransport TT INNER JOIN TRANSPORTER TR ON TT.id = TR.idTypeTransport WHERE TR.idExcursion = :id";

        $requete=$cnx->prepare($reqChaine);
        $requete->bindParam(":id",$id,PDO::PARAM_INT);
        $result=$requete->execute();
        $lesTypes = array();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
        {
            $id = $uneLigne['id'];
            $lib = $uneLigne['type'];
            $type = new TypeTransport($id,$lib);
        }
        return $lesTypes;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function SelectById(string $id) : TypeTransport
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="SELECT * FROM TypeTransport WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['lib'];
                $typeTransport = new TypeTransport($id,$lib);
                array_push($categorie,$typeTransport);
            }
        $requete->closeCursor();
        $cnx=null;
        return $typeTransport;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function DeleteById(string $id) : void
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="DELETE FROM TypeTransport WHERE id = :id";
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

    public static function Update(TypeTransport $TypeTransport) : void
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="UPDATE TypeTransport SET id = :id, lib = :lib WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$TypeTransport->GetId(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$TypeTransport->GetLib(),PDO::PARAM_STR);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function Insert(TypeTransport $TypeTransport) : void
    {
        try{
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="INSERT INTO TypeTransport VALUES (:id,:lib)";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$TypeTransport->GetId(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$TypeTransport->GetLib(),PDO::PARAM_STR);
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