<?php
include_once('./classes/Utilisateur.php');
class ModeleUtilisateur {


    public static function SelectAll() : array 
    {
        include_once('./connexpdo.inc.php');
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="SELECT * FROM Utilisateur";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        $lesUtilisateurs = array();
        while($uneLigne =$requete->fetch(PDO::FETCH_ASSOC))
        {
            $login = $uneLigne['login'];
            $mdp = $uneLigne['mdp'];
            $isAdmin = $uneLigne['isAdmin'];
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
        $cnx=connexpdo('gestion_excursions','myparam');
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
        $cnx=connexpdo('gestion_excursions','myparam');
        $reqChaine="UPDATE Utilisateur SET login = :login, mdp = :mdp, isAdmin = :isAdmin WHERE id = :id";
        $requete=$cnx->prepare($reqChaine);
        $requete->BindValue(":login", $utilisateur->GetLogin(),PDO::PARAM_STR);
        $requete->BindValue(":mdp", $utilisateur->GetMdp(), PDO::PARAM_STR);
        $requete->BindValue(":isAdmin", $utilisateur->GetIsAdmin(), PDO::PARAM_BOOL);
        $result=$requete->execute();
        $requete->closeCursor();
        $cnx=null;
    }

    public static function Insert(Utilisateur $utilisateur) : void 
    {
        include_once('./connexpdo.inc.php');
        $cnx = connexpdo('gestion_excursions','myparam');
        $reqChaine = "INSERT INTO Utilisateur (login, mdp, isAdmin) VALUES (:login, :mdp, :isAdmin)";
        $requete = $cnx->prepare($reqChaine);
        $requete->BindValue(":login", $utilisateur->GetLogin(), PDO::PARAM_STR);
        $requete->BindValue(":mdp", $utilisateur->GetMdp(), PDO::PARAM_STR);
        $requete->BindValue(":isAdmin", $utilisateur->GetIsAdmin(), PDO::PARAM_BOOL);
        $requete->execute();
        $cnx = null;
    }
}

?>