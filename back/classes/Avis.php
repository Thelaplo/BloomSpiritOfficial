<?php

class Avis 
{
    private int $numero;
    private string $login;
    private string $contenu;

    function __construct(int $numero, string $login, string $contenu)
    {
        $this->numero = $numero;
        $this->login = $login;
        $this->contenu = $contenu;
    }

}


?>