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

    public function GetId() : int
    {
        return $this->id;
    }

    public function GetNom() : string
    {
        return $this->nom;
    }

    public function GetDesc() : string
    {
        return $this->desc;
    }

    public function GetLatitude() : float
    {
        return $this->latitude;
    }

    public function GetLongitude() : float
    {
        return $this->longitude;
    }

    public function GetNote() : float
    {
        return $this->note;
    }

    public function GetImg() : string
    {
        return $this->img;
    }

    public function GetLieu() : TypeLieu
    {
        return $this->type;
    }

    public function SetId(int $id) : void
    {
        $this->id = $îd;
    }

    public function SetDesc(string $desc) : void
    {
        $this->desc = $desc;
    }

    public function SetNom(string $nom) : void
    {
        $this->nom = $nom;
    }

    public function SetLatitude(float $latitude) : void
    {
        $this->latitude = $latitude;
    }

    public function SetLongitude(float $longitude) : void
    {
        $this->longitude = $longitude;
    }

    public function SetNote(float $note) : void
    {
        $this->note = $note;
    }

    public function SetImg(string $img) : void
    {
        $this->img = $img;
    }

    public function SetType(TypeLieu $type) : void
    {
        $this->type = $type;
    }

}

?>