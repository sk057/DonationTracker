<?php

include_once 'Donation.php';
class DonationManager
{
    private array $donationArray;

    public function getDonationArray(): array
    {
        return $this->donationArray;
    }

    public function setDonationArray(array $donationArray): void
    {
        $this->donationArray = $donationArray;
    }

    public function __construct() {
        $this->donationArray = [];
    }

    public function addDonation(string $donorName, float $amount, int $charityId, DateTime $dateTime):void
    {
        if  ($this->validName($donorName) && $this->validAmount($amount) && $this->validDate($dateTime)){
            $id = count($this->donationArray);
            $donation = new Donation($id, $donorName, $amount, $charityId, $dateTime);
            $this->donationArray[] = $donation;
        }
    }

    private function validName(string $name):bool
    {
        if (strlen($name)>30){
            echo "Donor name is too long\n";
            return false;
        }
        else if (strlen($name)==0){
            echo "Donor name is blank\n";
            return false;
        }
        else {
            return true;
        }
    }

    private function validAmount(float $amount):bool{
        if ($amount<=0){
            echo "incorrect amount entered\n";
            return false;
        }
        else{
            return true;
        }
    }

    private function validDate(DateTime $date):bool
    {
        $currentTime = new DateTime();
        $pastTime = new DateTime("2000-01-01");
        if ($date>$currentTime){
            echo "Date is in the future\n";
            return false;
        }
        else if($date<$pastTime){
            echo "Date is in the past\n";
            return false;
        }
        else{
            return true;
        }
    }
}