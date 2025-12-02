<?php
    include_once('./classes/Etape.php');
    include_once('./connexpdo.inc.php');
    class ModeleEtape
    {

    public static function SelectAllEtape()
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Etape";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                foreach($uneLigne as $valeur)
                {
                    echo $valeur;
                }
            }                    
        $requete->closeCursor();
        $cnx=null;
    }

    public static function UpdateEtape(Etape $etape)
    {
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="UPDATE Categorie SET id = :id, lib = :lib WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(':id',$id,PDO::PARAM_STR);
        $requete->BindParam(':lib',$lib,PDO::PARAM_STR);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                foreach($uneLigne as $valeur)
                {
                    echo $valeur;
                }
            }                    
        $requete->closeCursor();
        $cnx=null;
    }
}

?>