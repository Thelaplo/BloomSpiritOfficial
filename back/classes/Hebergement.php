<?php

class Hebergement
{
    private int $id;
    private string $nom;
    private string $type;
    private float $etoiles;
    private string $rue;
    private string $cp;
    private string $ville;
    private int $capacite;

    public function __construct(int $id, string $nom, string $type, float $etoiles, string $rue, string $cp, string $ville, int $capacite)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->type = $type;
        $this->etoiles = $etoiles;
        $this->rue = $rue;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->capacite = $capacite;
    }

    public function GetId()
    {
        return $this->id;
    }

    public function GetNom()
    {
        return $this->nom;
    }

    public function GetEtoiles()
    {
        return $this->etoiles;
    }

    public function GetRue()
    {
        return $this->rue;
    }

    public function GetCp()
    {
        return $this->cp;
    }

    public function GetVille()
    {
        return $this->ville;
    }

    public function GetCapacite()
    {
        return $this->capacite;
    }

    public function SetId(int $id)
    {
        $this->id = $id;
    }

    public function SetNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function SetEtoiles(string $etoiles)
    {
        $this->etoiles = $etoiles;
    }

    public function SetRue(string $rue)
    {
        $this->rue = $rue;
    }

    public function SetCp(string $cp)
    {
        $this->cp = $cp;
    }

    public function SetVille(string $ville)
    {
        $this->ville = $ville;
    }

    public function SetCapacite(int $capacite)
    {
        $this->capacite = $capacite;
    }

}

?>