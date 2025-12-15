<?php

class TypeLieu
{
    private string $id;
    private string $libelle;

    function __construct(string $id, string $libelle)
    {
        $this->id = $id;
        $this->libelle = $libelle;
    }

    public function GetId() : string
    {
        return $this->id;
    }

    public function GetLibelle() : string
    {
        return $this->libelle;
    }

    public function SetId(string $id) : void
    {
        $this->id = $id;
    }

    public function SetLibelle(string $libelle) :void
    {
        $this->libelle = $libelle;
    }

}

?>