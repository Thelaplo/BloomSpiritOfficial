<?php

include_once("TypeTransport.php");
include_once("CategorieExcursion.php");
include_once("Etape.php");

class Excursion
{
    private string $id;
    private string $nom;
    private string $image;
    private string $desc;
    private int $duree;
    private string $difficulte;
    private int $nbLimitPers;
    private float $prix;
    private array $typeTransport;
    private CategorieExcursion $categorie;
    private array $etapes;

    public function __construct(string $id, string $nom, string $image, string $desc, int $duree, string $difficulte, int $nbLimitPers, float $prix, CategorieExcursion $categorie)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->image = $image;
        $this->desc = $desc;
        $this->duree = $duree;
        $this->difficulte = $difficulte;
        $this->nbLimitPers = $nbLimitPers;
        $this->prix = $prix;
        $this->typeTransport = array();
        $this->categorie = $categorie;
        $this->etapes = array();
    }

    public function GetId() : string
    {
        return $this->id;
    }

    public function GetNom() : string
    {
        return $this->nom;
    }
    public function GetImage() : string
    {
        return $this->image;
    }

    public function GetDesc() : string
    {
        return $this->desc;
    }

    public function GetDuree() : int
    {
        return $this->duree;
    }

    public function GetDifficulte() : string
    {
        return $this->difficulte;
    }

    public function GetNbLimitPers() : int
    {
        return $this->nbLimitPers;
    }

    public function GetPrix() : float
    {
        return $this->prix;
    }

    public function GetTypeTransport() : array
    {
        return $this->typeTransport;
    }

    public function GetCategorie() : CategorieExcursion
    {
        return $this->categorie;
    }

    public function GetEtapes() : array
    {
        return $this->etapes;
    }

    public function SetId(string $id) : void
    {
        $this->id = $id;
    }

    public function SetNom(string $nom) : void
    {
        $this->nom = $nom;
    }

    public function SetDesc(string $desc) : void
    {
        $this->desc = $desc;
    }

    public function SetDuree(int $duree) : void
    {
        $this->duree = $duree;
    }

    public function SetDifficulte(string $difficulte) : void
    {
        $this->difficulte = $difficulte;
    }

    public function SetNbLimitPers(int $nbLimitPers) : void
    {
        $this->nbLimitPers = $nbLimitPers;
    }

    public function SetPrix(float $prix) : void
    {
        $this->prix = $prix;
    }

    public function SetTypeTransport(array $typeTransport) : void
    {
        $this->typeTransport = $typeTransport;     
    }

    public function SetCategorie(CategorieExcursion $categorie) : void
    {
        $this->categorie = $categorie;
    }

    public function SetEtapes(array $etapes) : void
    {
        $this->etapes = $etapes;
    }

}


?>