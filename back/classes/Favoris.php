<?php

class Favoris 
{
    private string $login;
    private int $idExcursion;

    public function __construct(string $login, int $idExcursion)
    {
        $this->login = $login;
        $this->idExcursion = $idExcursion;
    }

    public function GetLogin() : string
    {
        return $this->login;
    }

    public function GetIdExcursion() : int
    {
        return $this->idExcursion;
    }
}
?>