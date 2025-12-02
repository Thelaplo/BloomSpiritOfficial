<?php

    include('./classes/CategorieExcursion.php');

    class ModeleCategorieExcursion
    {

    public static function SelectAllCategorieExcursion()
    {
        $categorie = array();
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Categorie";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $lib = $uneLigne['lib'];
                $cat = new CategorieExcursion($id,$lib);
                array_push($categorie,$cat);
            }
        echo "<br/>";
        echo "<br/>";
        print_r($categorie);
        echo "<br/>";
        echo "<br/>";

        $requete->closeCursor();
        $cnx=null;
    }

    public static function UpdateCategorieExcursion(string $id, string $lib)
    {
        include_once('./connexpdo.inc.php');
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