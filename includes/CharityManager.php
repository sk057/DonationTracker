<?php

include 'Charity.php';

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

    function __construct() {
        $this->charityArray = [];
    }

    function viewCharity(int $id): void
    {
        if (array_key_exists($id,$this->charityArray)){
            var_dump($this->charityArray[$id]);
        }
        else{
            echo "ID does not exist, enter new ID\n";
            $id = (int)readline();
            $this->viewCharity($id);
        }
    }

    function viewCharityByName(string $name):int
    {
        if ($this->checkNameExists($name)){
            foreach ($this->charityArray as $charity){
                if ($charity->name == $name){
                    var_dump($charity);
                    break;
                }
            }
            return 0;
        }
        else{
            echo "Charity does not exist";
            return -1;
        }
    }

    function addCharity($name, $email): void
    {
        if (!$this->checkNameExists($name) && $this->validName($name) &&  $this->validEmail($email)){
            //generating unique IDs
            $id = count($this->charityArray);
            $charity = new Charity($id, $name, $email);
            $this->charityArray[] = $charity;
        }
    }

    function editCharity($id,$name,$email):void
    {
        if (!$this->checkNameExists($name) && $this->validName($name) &&  $this->validEmail($email)){
            $this->charityArray[$id]->setName($name);
            $this->charityArray[$id]->setRepresentativeEmail($email);
        }
    }

    function deleteCharity($id,$donationArray): array
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

    //charity name should be unique
    function checkNameExists($name):bool
    {
        foreach ($this->charityArray as $charity){
            if ($charity->getName() == $name){
                echo "Charity name already exists\n";
                return true;
            }
        }
        return false;
    }

    function validEmail($email):bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Incorrect email format\n";
            return false;
        }
        else{
            return true;
        }
    }

    function validName($name):bool{
        if (strlen($name)>30){
            echo "Charity name is too long\n";
            return false;
        }
        else {
            return true;
        }
    }
}