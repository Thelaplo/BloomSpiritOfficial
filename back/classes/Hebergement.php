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
}

?>