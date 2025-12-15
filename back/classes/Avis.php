<?php

class Avis 
{
    private int $numero;
    private string $login;
    private int $idExcursion;
    private string $contenu;
    private int $note;

    function __construct(int $numero, string $login, int $idExcursion, string $contenu, int $note)
    {
        $this->numero = $numero;
        $this->login = $login;
        $this->idExcursion = $idExcursion;
        $this->contenu = $contenu;
        $this->note = $note;
    }

    public function GetNumero():int
    {
        return $this->numero;
    }

    public function GetLogin():string
    {
        return $this->login;
    }

    public function GetIdExcursion():int
    {
        return $this->idExcursion;
    }

    public function GetContenu():string
    {
        return $this->contenu;
    }

    public function GetNote():int
    {
        return $this->note;
    }
}


?>