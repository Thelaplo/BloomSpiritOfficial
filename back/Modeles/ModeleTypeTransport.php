<?php

    include('./classes/TypeTransport.php');
    include_once('./connexpdo.inc.php');


    class ModeleTypeTransport
    {

    public static function SelectAllTransport() : array
    {
        $transport = array();
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM TypeTransport";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['lib'];
                $cat = new TypeTransport($id,$lib);
                array_push($categorie,$cat);
            }
        $requete->closeCursor();
        $cnx=null;
        return $transport;
    }

    public static function SelectTransportByIdExcursion(int $id) : array
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM TypeTransport TT INNER JOIN TRANSPORTER TR ON TT.id = TR.idTypeTransport WHERE TR.idExcursion = :id";

        $requete=$cnx->prepare($reqChaine);
        $requete->bindParam(":id",$id,PDO::PARAM_INT);
        $result=$requete->execute();
        $lesTypes = array();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
        {
            $id = $uneLigne['id'];
            $lib = $uneLigne['lib'];
            $type = new TypeTransport($id,$lib);
        }
        return $lesTypes;
    }

    public static function SelectByIdTransport(string $id) : TypeTransport
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM TypeTransport WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['lib'];
                $cat = new TypeTransport($id,$lib);
                array_push($categorie,$cat);
            }
        $requete->closeCursor();
        $cnx=null;
        return $cat;
    }

    public static function DeleteByIdTypeTransport(string $id) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="DELETE FROM TypeTransport WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
    }

    public static function UpdateTypeTransport(TypeTransport $TypeTransport) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="UPDATE TypeTransport SET id = :id, lib = :lib WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$TypeTransport->GetId(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$TypeTransport->GetLib(),PDO::PARAM_STR);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
    }

    public static function InsertTypeTransport(TypeTransport $TypeTransport) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="INSERT INTO TypeTransport VALUES (:id,:lib)";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$TypeTransport->GetId(),PDO::PARAM_STR);
        $requete->BindParam(':lib',$TypeTransport->GetLib(),PDO::PARAM_STR);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
    }

}

?>