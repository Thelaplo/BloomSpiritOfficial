<?php

class Hebergement
{
    private int $id;
    private string $nom;
    private string $type;
    private float $etoiles;
    private string $rue;
    private string $img;
    private string $cp;
    private string $ville;
    private int $capacite;

    public function __construct(int $id, string $nom, string $type, float $etoiles, string $rue, string $img, string $cp, string $ville, int $capacite)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->type = $type;
        $this->etoiles = $etoiles;
        $this->rue = $rue;
        $this->img = $img;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->capacite = $capacite;
    }

    public function GetId() : int
    {
        return $this->id;
    }

    public function GetNom() : string
    {
        return $this->nom;
    }

    public function GetType() : string
    {
        return $this->type;
    }

    public function GetEtoiles() : float
    {
        return $this->etoiles;
    }

    public function GetRue() : string
    {
        return $this->rue;
    }

    public function GetCp() : string
    {
        return $this->cp;
    }

    public function GetVille() : string
    {
        return $this->ville;
    }

    public function GetCapacite() : int
    {
        return $this->capacite;
    }

    public function SetId(int $id) : void
    {
        $this->id = $id;
    }

    public function SetNom(string $nom) : void
    {
        $this->nom = $nom;
    }

    public function SetType(string $type) : void
    {
        $this->type = $type;
    }

    public function SetEtoiles(string $etoiles) : void
    {
        $this->etoiles = $etoiles;
    }

    public function SetRue(string $rue) : void
    {
        $this->rue = $rue;
    }

    public function SetCp(string $cp) : void
    {
        $this->cp = $cp;
    }

    public function SetVille(string $ville) : void
    {
        $this->ville = $ville;
    }

    public function SetCapacite(int $capacite) : void
    {
        $this->capacite = $capacite;
    }

}

?>