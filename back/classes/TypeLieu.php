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
}

?>