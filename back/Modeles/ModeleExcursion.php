<?php

    class ModeleExcursion
    {

    public static function SelectAllExcursion()
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Excursion";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        $lesExcursions = array();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
                $id = $uneLigne['id'];
                $nom = $uneLigne['nom'];
                $typetransport = ModeleTypeTransport::SelectByExcursion($id);
                $excurs = new Excursion();
                array_push($categorie,$cat);
            }                    
        $requete->closeCursor();
        $cnx=null;
    }

}

?>