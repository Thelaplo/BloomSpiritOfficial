<?php

class TypeTransport 
{
    private string $id;
    private string $type;

    function __construct(string $id, string $type)
    {
        $this->id = $id;
        $this->type = $type;
    }
}

?>