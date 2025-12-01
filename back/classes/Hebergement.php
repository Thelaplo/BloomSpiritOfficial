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

    public function SetId()
    {
        $this->id = $id;
    }

    public function SetNom()
    {
        $this->nom = $nom;
    }

    public function SetEtoiles()
    {
        $this->etoiles = $etoiles;
    }

    public function SetRue()
    {
        $this->rue = $rue;
    }

    public function SetCp()
    {
        $this->cp = $cp;
    }

    public function SetVille()
    {
        $this->ville = $ville;
    }

    public function SetCapacite()
    {
        $this->capacite = $capacite;
    }
}

?>