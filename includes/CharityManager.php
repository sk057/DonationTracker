<?php

include_once 'Charity.php';
include_once 'Donation.php';

class CharityManager
{
    private array $charityArray;

    public function getCharityArray(): array
    {
        return $this->charityArray;
    }

    public function setCharityArray(array $charityArray): void
    {
        $this->charityArray = $charityArray;
    }

    public function __construct(){
        $this->charityArray = [];
    }

    public function viewCharity(int $id): void
    {
        if (array_key_exists($id,$this->charityArray)){
            $this->charityArray[$id]->toString();
        }
        else{
            echo "ID does not exist, enter new ID\n";
            $id = (int)readline();
            $this->viewCharity($id);
        }
    }

    public function addCharity(string $name, string $email): void
    {
        if (!$this->checkNameExists($name) && $this->validName($name) &&  $this->validEmail($email)){
            //generating unique IDs
            $id = count($this->charityArray);
            $charity = new Charity($id, $name, $email);
            $this->charityArray[] = $charity;
        }
    }

    public function editCharity(int $id, string $name, string $email):void
    {
        if (array_key_exists($id,$this->charityArray)){
            if (!$this->checkNameExists($name) && $this->validName($name) &&  $this->validEmail($email)){
                $this->charityArray[$id]->setName($name);
                $this->charityArray[$id]->setRepresentativeEmail($email);
            }
        }
        else{
            echo "ID does not exist";
        }
    }

    public function deleteCharity(int $id, array $donationArray): array
    {
        if (array_key_exists($id,$this->charityArray)){
            array_splice($this->charityArray, $id, 1);
            //updating the donation->charity IDs after deletion
            for ($x = 0; $x < count($donationArray); $x++){
                if($donationArray[$x]->getCharityId()>$id) {
                    $donationArray[$x]->setCharityId($donationArray[$x]->getCharityId() - 1);
                }
            }
            return $donationArray;
        }
        else{
            echo "ID does not exist";
            return $donationArray;
        }
    }

    public function appendArray(array $moreCharities):void
    {
        foreach($moreCharities as $charity){
            if (!$this->checkNameExists($charity->getName()) && $this->validName($charity->getName())
                &&  $this->validEmail($charity->getRepresentativeEmail())){
                $charity->setId(count($this->charityArray));
                $this->charityArray[] = $charity;
            }
        }
    }

    //charity name should be unique
    private function checkNameExists(string $name):bool
    {
        foreach ($this->charityArray as $charity){
            if ($charity->getName() == $name){
                echo "Charity name already exists\n";
                return true;
            }
        }
        return false;
    }

    private function validEmail(string $email):bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Incorrect email format\n";
            return false;
        }
        else if (strlen($email)>30){
            echo "Email is too long\n";
            return false;
        }
        else{
            return true;
        }
    }

    private function validName(string $name):bool{
        if (strlen($name)>30){
            echo "Charity name is too long\n";
            return false;
        }
        else if(strlen($name)==0){
            echo "Charity name is blank\n";
            return false;
        }
        else {
            return true;
        }
    }
}