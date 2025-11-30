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

}


?>