<?php

class Donation
{
    public $id;
    public $donorName;
    public $amount;
    public $charityId;
    public $dateTime;

    function __construct($id, $donorName, $amount, $charityI, $dateTime) {
        $this->id = $id;
        $this->donorName = $donorName;
        $this->amount = $amount;
        $this->charityId = $charityI;
        $this->dateTime = $dateTime;
    }
}