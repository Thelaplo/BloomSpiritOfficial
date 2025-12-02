<?php

    class ModeleHebergement
    {

    public static function SelectAllHebergement()
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Hebergement";
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