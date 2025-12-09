<?php
    include('./classes/Hebergement.php');
    include_once('./connexpdo.inc.php');


    class ModeleHebergement
    {

    public static function SelectAllHebergement() : array
    {
        $categorie = array();
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
                $cat = new Hebergement($id,$lib,$type,$etoiles,$adr,$img,$cp,$ville,$cap);
                array_push($categorie,$cat);
            }
        $requete->closeCursor();
        $cnx=null;
        return $categorie;
    }

    public static function SelectByIdHebergement(string $id) : Hebergement
    {
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
                $cat = new Hebergement($id,$lib,$type,$etoiles,$adr,$img,$cp,$ville,$cap);
            }
        $requete->closeCursor();
        $cnx=null;
        return $cat;
    }

    public static function DeleteByIdHebergement(int $id) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="DELETE FROM Hebergement WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
    }

    public static function UpdateHebergement(Hebergement $categorie) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="UPDATE Hebergement SET id = :id, nom = :lib, type = :type, etoiles = CONVERT(:etoiles, DECIMAL), adresse = :adr, image = :img, cp = :cp, ville = :ville, capacite = :cap WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$categorie->GetId(),PDO::PARAM_INT);
        $requete->BindParam(':lib',$categorie->GetNom(),PDO::PARAM_STR);
        $requete->BindParam(':type',$categorie->GetType(),PDO::PARAM_STR);
        $requete->BindParam(':etoiles',(string)$categorie->GetEtoiles(),PDO::PARAM_STR);
        $requete->BindParam(':adr',(string)$categorie->GetRue(),PDO::PARAM_STR);
        $requete->BindParam(':img',(string)$categorie->GetImg(),PDO::PARAM_STR);
        $requete->BindParam(':cp',$categorie->GetCP(),PDO::PARAM_STR);
        $requete->BindParam(':ville',$categorie->GetVille(),PDO::PARAM_STR);
        $requete->BindParam(':cap',$categorie->GetCapacite()->GetId(),PDO::PARAM_INT);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
    }

    public static function InsertHebergement(Hebergement $categorie) : void
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="INSERT INTO Hebergement VALUES (:id, :lib, :type, CONVERT(:etoiles, DECIMAL), :adr, :img, :cp, :ville, :cap)";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$categorie->GetId(),PDO::PARAM_INT);
        $requete->BindParam(':lib',$categorie->GetNom(),PDO::PARAM_STR);
        $requete->BindParam(':type',$categorie->GetType(),PDO::PARAM_STR);
        $requete->BindParam(':etoiles',(string)$categorie->GetEtoiles(),PDO::PARAM_STR);
        $requete->BindParam(':adr',(string)$categorie->GetRue(),PDO::PARAM_STR);
        $requete->BindParam(':img',(string)$categorie->GetImg(),PDO::PARAM_STR);
        $requete->BindParam(':cp',$categorie->GetCP(),PDO::PARAM_STR);
        $requete->BindParam(':ville',$categorie->GetVille(),PDO::PARAM_STR);
        $requete->BindParam(':cap',$categorie->GetCapacite()->GetId(),PDO::PARAM_INT);
        $result=$requete->execute();                   
        $requete->closeCursor();
        $cnx=null;
    }

}

?>