<?php

class Etape
{
    private int $id;
    private string $nom;
    private string $desc;
    private float $latitude;
    private float $longitude;
    private float $note;
    private string $img;

    public function __construct(int $id, string $nom, string $desc, float $latitude, float $longitude, float $note, string $img)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->desc = $desc;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->note = $note;
        $this->img = $img;
    }
}

?>