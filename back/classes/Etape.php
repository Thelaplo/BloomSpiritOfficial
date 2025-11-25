<?php

class Etape
{
    private int $numero;
    private string $desc;
    private int $dureEstimee;

    public function __construct(int $numero, string $desc, int $dureEstimee)
    {
        $this->numero = $numero;
        $this->desc = $desc;
        $this->dureeEstimee = $dureEstimee;
    }
}

?>