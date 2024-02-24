<?php

class Charity
{
    public int $id;
    public string $name;
    public string $representativeEmail;

    function __construct($id, $name, $representativeEmail) {
        $this->id = $id;
        $this->name = $name;
        $this->representativeEmail = $representativeEmail;
    }
}