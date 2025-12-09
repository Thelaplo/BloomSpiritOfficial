<?php

class ModeleUtilisateur {


    public static function SelectAll() : array 
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Utilisateur";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        $lesUtilisateurs = array();
        while($unLigne =$requete->fetch(PDO::FETCH_ASSOC))
        {
            $login = $uneLigne['login'];
            $mdp = $uneLigne['mdp'];
            $isAdmin = $uneLigne['IsAdmin'];
            $unUser = new Utilisateur($login, $mdp, $isAdmin);
            array_push($lesUtilisateurs,$unUser);
        }
        $requete->closeCursor();
        $cnx=null;
        return $lesUtilisateurs;
    }

    public static function DeleteById(int $id) : void
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="DELETE FROM Utilisateur WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(":id",$id,PDO::PARAM_INT);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
    }

    public static function Update(Utilisateur $utilisateur) : void
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="UPDATE Utilisateur SET login = :login, mdp = :mdp, IsAdmin = :IsAdmin WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindParam(":login", $utilisateur->GetLogin(),PDO::PARAM_STR);
        $requete->BindParam(":mdp", $utilisateur->GetMdp(), PDO::PARAM_STR);
        $requete->BidnParam(":IsAdmin", $utilisateur->GetIsAdmin(), PDO::PARAM_BOOL);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
    }
}

?>