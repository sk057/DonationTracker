<?php

class Charity
{
    private int $id;
    private string $name;
    private string $representativeEmail;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRepresentativeEmail(): string
    {
        return $this->representativeEmail;
    }

    public function setRepresentativeEmail(string $representativeEmail): void
    {
        $this->representativeEmail = $representativeEmail;
    }

    function __construct($id, $name, $representativeEmail) {
        $this->id = $id;
        $this->name = $name;
        $this->representativeEmail = $representativeEmail;
    }

    function toString():void{
        echo "$this->id, $this->name, $this->representativeEmail\n";
    }
}