<?php

class Lieu
{
    private int $id;
    private string $nom;
    private string $desc;
    private float $latitude;
    private float $longitude;
    private float $note;
    private string $img;
    private TypeLieu $type;

    public function __construct(int $id, string $nom, string $desc, float $latitude, float $longitude, float $note, string $img, TypeLieu $type)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->desc = $desc;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->note = $note;
        $this->img = $img;
        $this->type = $type;
    }

    public function GetId()
    {
        return $this->id;
    }

    public function GetNom()
    {
        return $this->nom;
    }

    public function GetDesc()
    {
        return $this->desc;
    }

    public function GetLatitude()
    {
        return $this->latitude;
    }

    public function GetLongitude()
    {
        return $this->longitude;
    }

    public function GetNote()
    {
        return $this->note;
    }

    public function GetImg()
    {
        return $this->img;
    }

    public function GetLieu()
    {
        return $this->type;
    }

    public function SetId(int $id)
    {
        $this->id = $îd;
    }

    public function SetDesc(string $desc)
    {
        $this->desc = $desc;
    }

    public function SetNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function SetLatitude(float $latitude)
    {
        $this->latitude = $latitude;
    }

    public function SetLongitude(float $longitude)
    {
        $this->longitude = $longitude;
    }

    public function SetNote(float $note)
    {
        $this->note = $note;
    }

    public function SetImg(string $img)
    {
        $this->img = $img;
    }

    public function SetType(TypeLieu $type)
    {
        $this->type = $type;
    }

    public function SelectAllLieu()
    {
        	include_once('../connexpdo.inc.php');
        $cnx=connexpdo('bdExcursion','myparam');
        $reqChaine="SELECT * FROM Lieu";
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