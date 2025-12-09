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

}


?>