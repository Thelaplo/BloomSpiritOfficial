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