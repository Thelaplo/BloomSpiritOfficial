<?php

include_once("TypeTransport.php");
include_once("CategorieExcursion.php");
include_once("Etape.php");

class Excursion
{
    private string $id;
    private string $nom;
    private string $desc;
    private int $duree;
    private string $difficulte;
    private int $nbLimitPers;
    private float $prix;
    private array $typeTransport;
    private CategorieExcursion $categorie;
    private array $etapes;

    public function __construct(string $id, string $nom, string $desc, int $duree, string $difficulte, int $nbLimitPers, float $prix, CategorieExcursion $categorie)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->desc = $desc;
        $this->duree = $duree;
        $this->difficulte = $difficulte;
        $this->nbLimitPers = $nbLimitPers;
        $this->prix = $prix;
        $this->typeTransport = array();
        $this->categorie = $categorie;
        $this->etapes = array();
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

    public function GetDuree()
    {
        return $this->duree;
    }

    public function GetDifficulte()
    {
        return $this->difficulte;
    }

    public function GetNbLimitPers()
    {
        return $this->nbLimitPers;
    }

    public function GetPrix()
    {
        return $this->prix;
    }

    public function GetTypeTransport()
    {
        return $this->typeTransport;
    }

    public function GetCategorie()
    {
        return $this->categorie;
    }

    public function GetEtapes()
    {
        return $this->Etapes;
    }

    public function SetId(string $id)
    {
        $this->id = $id;
    }

    public function SetNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function SetDesc(string $desc)
    {
        $this->desc = $desc;
    }

    public function SetDuree(int $duree)
    {
        $this->duree = $duree;
    }

    public function SetDifficulte(string $difficulte)
    {
        $this->difficulte = $difficulte;
    }

    public function SetNbLimitPers(int $nbLimitPers)
    {
        $this->nbLimitPers = $nbLimitPers;
    }

    public function SetPrix(float $prix)
    {
        $this->prix = $prix;
    }

    public function SetTypeTransport(array $typeTransport)
    {
        $this->typeTransport = $typeTransport;     
    }

    public function SetCategorie(CategorieExcurion $categorie)
    {
        $this->categorie = $categorie;
    }

    public function SetEtapes(array $etapes)
    {
        $this->etapes = $etapes;
    }
}


?>