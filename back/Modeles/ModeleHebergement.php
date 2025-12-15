<?php
    include('./classes/Hebergement.php');
    include_once('./connexpdo.inc.php');


    class ModeleHebergement
    {

    public static function SelectAll() : array
    {
        try{
        $hebergement = array();
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Hebergement";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['nom'];
                $type = $uneLigne['type'];
                $etoiles = $uneLigne['etoiles'];
                $adr = $uneLigne['adresse'];
                $img = $uneLigne['image'];
                $cp = $uneLigne['cp'];
                $ville = $uneLigne['ville'];
                $cap = $uneLigne['capacite'];
                $heb = new Hebergement($id,$lib,$type,$etoiles,$adr,$img,$cp,$ville,$cap);
                array_push($hebergement,$heb);
            }
        $requete->closeCursor();
        $cnx=null;
        return $hebergement;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function SelectById(string $id) : Hebergement
    {
        try{
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Hebergement WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['nom'];
                $type = $uneLigne['type'];
                $etoiles = $uneLigne['etoiles'];
                $adr = $uneLigne['adresse'];
                $img = $uneLigne['image'];
                $cp = $uneLigne['cp'];
                $ville = $uneLigne['ville'];
                $cap = $uneLigne['capacite'];
                $heb = new Hebergement($id,$lib,$type,$etoiles,$adr,$img,$cp,$ville,$cap);
            }
        $requete->closeCursor();
        $cnx=null;
        return $heb;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function DeleteById(int $id) : void
    {
        try{
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="DELETE FROM Hebergement WHERE id = :id";
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

    public static function Update(Hebergement $hebergement) : void
    {
        try{
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="UPDATE Hebergement SET id = :id, nom = :lib, type = :type, etoiles = CONVERT(:etoiles, DECIMAL), adresse = :adr, image = :img, cp = :cp, ville = :ville, capacite = :cap WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$hebergement->GetId(),PDO::PARAM_INT);
        $requete->BindParam(':lib',$hebergement->GetNom(),PDO::PARAM_STR);
        $requete->BindParam(':type',$hebergement->GetType(),PDO::PARAM_STR);
        $requete->BindParam(':etoiles',(string)$hebergement->GetEtoiles(),PDO::PARAM_STR);
        $requete->BindParam(':adr',(string)$hebergement->GetRue(),PDO::PARAM_STR);
        $requete->BindParam(':img',(string)$hebergement->GetImg(),PDO::PARAM_STR);
        $requete->BindParam(':cp',$hebergement->GetCP(),PDO::PARAM_STR);
        $requete->BindParam(':ville',$hebergement->GetVille(),PDO::PARAM_STR);
        $requete->BindParam(':cap',$hebergement->GetCapacite()->GetId(),PDO::PARAM_INT);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
        } catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function Insert(Hebergement $hebergement) : void
    {
        try{
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="INSERT INTO Hebergement VALUES (:id, :lib, :type, CONVERT(:etoiles, DECIMAL), :adr, :img, :cp, :ville, :cap)";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$hebergement->GetId(),PDO::PARAM_INT);
        $requete->BindParam(':lib',$hebergement->GetNom(),PDO::PARAM_STR);
        $requete->BindParam(':type',$hebergement->GetType(),PDO::PARAM_STR);
        $requete->BindParam(':etoiles',(string)$hebergement->GetEtoiles(),PDO::PARAM_STR);
        $requete->BindParam(':adr',(string)$hebergement->GetRue(),PDO::PARAM_STR);
        $requete->BindParam(':img',(string)$hebergement->GetImg(),PDO::PARAM_STR);
        $requete->BindParam(':cp',$hebergement->GetCP(),PDO::PARAM_STR);
        $requete->BindParam(':ville',$hebergement->GetVille(),PDO::PARAM_STR);
        $requete->BindParam(':cap',$hebergement->GetCapacite()->GetId(),PDO::PARAM_INT);
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