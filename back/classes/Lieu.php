<?php

class Lieu
{
    private int $id;
    private string $nom;
    private string $desc;
    private float $latitude;
    private float $longitude;
    private float $note;
    private string $img;
    private TypeLieu $type;

    public function __construct(int $id, string $nom, string $desc, float $latitude, float $longitude, float $note, string $img, TypeLieu $type)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->desc = $desc;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->note = $note;
        $this->img = $img;
        $this->type = $type;
    }
}

?>