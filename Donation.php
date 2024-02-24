<?php

class Donation
{
    public int $id;
    public string $donorName;
    public float $amount;
    public int $charityId;
    public DateTime $dateTime;

    function __construct($id, $donorName, $amount, $charityI, $dateTime) {
        $this->id = $id;
        $this->donorName = $donorName;
        $this->amount = $amount;
        $this->charityId = $charityI;
        $this->dateTime = $dateTime;
    }
}