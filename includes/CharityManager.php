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

    function addCharity($name, $representativeEmail): int
    {
        if ($this->checkNameExists($name) && $this->validName($name)){

            return -1;
        }
        else{
            //generating unique IDs
            $id = count($this->charityArray);
            $charity = new Charity($id, $name, $representativeEmail);
            $this->charityArray[] = $charity;
            return 0;
        }
    }

    function editCharity($id,$name,$email):void
    {
        $this->charityArray[$id]->setName($name);
        $this->charityArray[$id]->setRepresentativeEmail($email);
    }

    function deleteCharity($id): void
    {
        unset($this->charityArray[$id]); //how does this interact with the rest of the ids?
    }

    //charity name should be unique
    function checkNameExists($name):bool
    {
        foreach ($this->charityArray as $charity){
            if ($charity->getName() == $name){
                echo "Charity name already exists";
                return true;
            }
        }
        return false;
    }

    function validEmail($email):bool
    {

    }

    function validName($name):bool{
        if (strlen($name)>50){
            echo "Charity name is too long";
            return false;
        }
        else {
            return true;
        }
    }
}