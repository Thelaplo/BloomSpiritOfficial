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

}

?>