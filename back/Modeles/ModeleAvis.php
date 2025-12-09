<?php

class ModeleUtilisateur {


    public static function SelectAll() : array 
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Avis";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        $lesAvis = array();
        while($unLigne =$requete->fetch(PDO::FETCH_ASSOC))
        {
            $numero = $uneLigne['numero'];
            $login = $uneLigne['login'];
            $idExcursion = $uneLigne['idExcursion'];
            $contenu = $uneLigne['contenu'];
            $note = $uneLigne['note'];
            $unAvis = new Avis($numero, $login, $idExcursion, $contenu, $note);
            array_push($lesAvis,$unAvis);
        }
        $requete->closeCursor();
        $cnx=null;
        return $lesAvis;
    }

    public static function SelectByIdAndNumero(int $id, int $numero): array
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Avis A INNER JOIN Excursion E ON A.id = E.id WHERE E.idExcursion = :id AND E.numero = :numero";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        $lesAvis = array();
        while($unLigne =$requete->fetch(PDO::FETCH_ASSOC))
        {
            $numero = $uneLigne['numero'];
            $login = $uneLigne['login'];
            $idExcursion = $uneLigne['idExcursion'];
            $contenu = $uneLigne['contenu'];
            $note = $uneLigne['note'];
            $unAvis = new Avis($numero, $login, $idExcursion, $contenu, $note);
            array_push($lesAvis,$unAvis);
        }
        $requete->closeCursor();
        $cnx=null;
        return $lesAvis;
    }

    public static function SelectByIdExcursion(int $id): array
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Avis A INNER JOIN Excursion E ON A.id = E.id WHERE E.idExcursion = :id";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        $lesAvis = array();
        while($unLigne =$requete->fetch(PDO::FETCH_ASSOC))
        {
            $numero = $uneLigne['numero'];
            $login = $uneLigne['login'];
            $idExcursion = $uneLigne['idExcursion'];
            $contenu = $uneLigne['contenu'];
            $note = $uneLigne['note'];
            $unAvis = new Avis($numero, $login, $idExcursion, $contenu, $note);
            array_push($lesAvis,$unAvis);
        }
        $requete->closeCursor();
        $cnx=null;
        return $lesAvis;
    }

    public static function SelectByIdUtilisateur(int $id): array
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Avis A INNER JOIN Utilisateur U ON A.id = U.id WHERE U.idUtilisateur = :id";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        $lesAvis = array();
        while($unLigne =$requete->fetch(PDO::FETCH_ASSOC))
        {
            $numero = $uneLigne['numero'];
            $login = $uneLigne['login'];
            $idExcursion = $uneLigne['idExcursion'];
            $contenu = $uneLigne['contenu'];
            $note = $uneLigne['note'];
            $unAvis = new Avis($numero, $login, $idExcursion, $contenu, $note);
            array_push($lesAvis,$unAvis);
        }
        $requete->closeCursor();
        $cnx=null;
        return $lesAvis;
    }

    public static function DeleteByIdAndNumero(int $id, int $numero) : void
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="DELETE FROM Avis WHERE id = :id AND numero = :numero";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(":id",$id,PDO::PARAM_INT);
        $requete->BindParam(":numero", $numero, PDO::PARAM_INT);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
    }

    public static function Update(Avis $avis) : void
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="UPDATE Avis SET numero = :numero, login = :login, idExcursion = :idExcursion, contenu = :contenu, note = :note WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(":numero", $numero, PDO::PARAM_INT);
        $requete->BindParam(":login", $login,PDO::PARAM_STR);
        $requete->BindParam(":idExcursion", $idExcursion, PDO::PARAM_INT);
        $requete->BidnParam(":contenu", $contenu, PDO::PARAM_STR);
        $requete->BidnParam(":note", $note, PDO::PARAM_STR);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
    }
}

?>