<?php

class CategorieExcursion
{
    private string $id;
    private string $libelle;

    public function __construct(string $id, string $libelle)
    {
        $this->id = $id;
        $this->libelle = $libelle;
    }
    
    public function GetId()
    {
        return $this->id;
    }

    public function GetLibelle()
    {
        return $this->libelle;
    }

    public function SetId(string $id)
    {
        $this->id = $id;
    }

    public function SetLibelle(string $libelle)
    {
        $this->libelle = $libelle;
    }

    public function SelectAllCategorieExcursion()
    {
        	include_once('../connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Categorie";
        $requete=$cnx->prepare($reqChaine);
        $result=$requete->execute();
        while($uneLigne=$requete->fetch(PDO::FETCH_ASSOC)) 
            {
			echo "<tr>";
			foreach($uneLigne as $valeur)
			{
				echo "<td> $valeur </td>";
			}
			echo "</tr>";
        }
                echo "</table>";
                
        $requete->closeCursor();
        $cnx=null;
    }
}

?>