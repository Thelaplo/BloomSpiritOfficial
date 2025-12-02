<?php

    class ModeleTypeTransport
    {

    public static function SelectAllTypeTransport()
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM TypeTransport";
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

    public static function SelectByExcursion(int $id)
    {
        include_once('./connexpdo.inc.php');
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
            array_push($lesTypes,$type);
        }
        return $lesTypes;
}

}

?>