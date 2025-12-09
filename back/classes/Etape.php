<?php

include_once("Lieu.php");

class Etape
{
    private int $numero;
    private string $desc;
    private int $dureeEstimee;
    private Lieu $lieu;

    public function __construct(int $numero, string $desc, int $dureeEstimee, Lieu $lieu)
    {
        $this->numero = $numero;
        $this->desc = $desc;
        $this->dureeEstimee = $dureeEstimee;
        $this->lieu = $lieu;
    }

    public function GetNumero() : int
    {
        return $this->numero;
    }

    public function GetDesc() : string
    {
        return $this->desc;
    }

    public function GetDureeEstimee() : int
    {
        return $this->dureeEstimee;
    }

    public function GetLieu() : Lieu
    {
        return $this->lieu;
    }

    public function SetNumero(int $numero) : void
    {
        $this->numero = $numero;
    }
    
    public function SetDesc(string $desc) : void
    {
        $this->desc = $desc;
    }

    public function SetDureeEstimee(int $dureeEstimee) : void
    {
        $this->dureeEstimee = $dureeEstimee;
    }
    
    public function SetLieu(Lieu $lieu) : void
    {
        $this->lieu = $lieu;
    }
}

?>