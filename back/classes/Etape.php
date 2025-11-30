<?php

include_once("Lieu.php");

class Etape
{
    private int $numero;
    private string $desc;
    private int $dureeEstimee;
    private Lieu $lieu;

    public function __construct(int $numero, string $desc, int $dureEstimee, Lieu $lieu)
    {
        $this->numero = $numero;
        $this->desc = $desc;
        $this->dureeEstimee = $dureEstimee;
        $this->lieu = $lieu;
    }
}

?>