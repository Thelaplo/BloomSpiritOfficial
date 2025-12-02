<?php

    class ModeleTypeLieu
    {

    public static function SelectAllTypeLieu()
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM TypeLieu";
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

}

?>