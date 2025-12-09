<?php

class TypeTransport 
{
    private string $id;
    private string $type;

    function __construct(string $id, string $type)
    {
        $this->id = $id;
        $this->type = $type;
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

    public function SetLibelle(string $libelle) : void
    {
        $this->libelle = $libelle;
    }

}

?>