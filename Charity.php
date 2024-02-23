<?php

class Charity
{
    public $id;
    public $name;
    public $representativeEmail;

    function __construct($id, $name, $representativeEmail) {
        $this->id = $id;
        $this->name = $name;
        $this->representativeEmail = $representativeEmail;
    }
}