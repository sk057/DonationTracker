<?php

class Donation
{
    private int $id;
    private string $donorName;
    private float $amount;
    private int $charityId;
    private DateTime $dateTime;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDonorName(): string
    {
        return $this->donorName;
    }

    public function setDonorName(string $donorName): void
    {
        $this->donorName = $donorName;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getCharityId(): int
    {
        return $this->charityId;
    }

    public function setCharityId(int $charityId): void
    {
        $this->charityId = $charityId;
    }

    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    public function setDateTime(DateTime $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    function __construct($id, $donorName, $amount, $charityId, $dateTime) {
        $this->id = $id;
        $this->donorName = $donorName;
        $this->amount = $amount;
        $this->charityId = $charityId;
        $this->dateTime = $dateTime;
    }

    function toString():void
    {
        echo "$this->id, $this->donorName, $this->amount, $this->charityId, $this->dateTime\n";
    }
}