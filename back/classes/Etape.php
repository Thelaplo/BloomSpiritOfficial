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

    public function GetNumero()
    {
        return $this->numero;
    }

    public function GetDesc()
    {
        return $this->desc;
    }

    public function GetDureeEstimee()
    {
        return $this->dureeEstimee;
    }

    public function GetLieu()
    {
        return $this->lieu;
    }

    public function SetNumero(int $numero)
    {
        $this->numero = $numero;
    }
    
    public function SetDesc(string $desc)
    {
        $this->desc = $desc;
    }

    public function SetDureeEstimee(int $dureeEstimee)
    {
        $this->dureeEstimee = $dureeEstimee;
    }
    
    public function SetLieu(Lieu $lieu)
    {
        $this->lieu = $lieu;
    }


}

?>