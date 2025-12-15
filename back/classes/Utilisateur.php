<?php

class Utilisateur
{
    private string $login;
    private string $mdp;
    private bool $IsAdmin;

    function __construct(string $login, string $mdp, bool $IsAdmin)
    {
        $this->login = $login;
        $this->mdp = $mdp;
        $this->IsAdmin = $IsAdmin;
    }

    public function GetLogin() : string
    {
        return $this->login;
    }

    public function GetMdp():string
    {
        return $this->mdp;
    }

    public function GetIsAdmin():bool
    {
        return $this->IsAdmin;
    }
}

?>