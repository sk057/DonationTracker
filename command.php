#!/usr/bin/php
<?php

include 'includes/CharityManager.php';

$charityManager = new CharityManager();
echo "<pre>";
//integrate csv manager here
while(true){
    echo "1-view, 2-add, 3-edit, 4-delete, 5-new donation, 6-quit\n";
    $choice = (int)readline();
    if($choice>6  || $choice<1)
        echo "Incorrect input\n";
    else{
        switch ($choice){
            case 1: {
                if (count($charityManager->getCharityArray())>0){
                    echo "Enter charity ID\n"; //or name
                    $id = (int)readline();
                    $charityManager->viewCharity($id);
                }
                else{
                    echo "Charity list is empty\n";
                }
                break;
            }
            case 2:{
                echo "Enter charity name and rep email\n";
                $name = (string)readline();
                $email = (string)readline();
                $charityManager->addCharity($name,$email);
                break;
            }
            case 3:{
                echo "Enter ID\n";
                $id = (int)readline();
                if (array_key_exists($id,$charityManager->getCharityArray())){
                    echo "Enter new name and email\n";
                    $name = (string)readline();
                    $email = (string)readline();
                    $charityManager->editCharity($id,$name,$email);
                }
                else{
                    echo "ID does not exist\n";
                }
                break;
            }
            case 4:{
                echo "Enter ID\n";
                $id = (int)readline();
                if (array_key_exists($id,$charityManager->getCharityArray())){
                    $charityManager->deleteCharity($id);
                }
                else{
                    echo "ID does not exist\n";
                }
                break;
            }
            case 6:{
                break 2;
            }
        }
    }

//var_dump($charityManager->getCharityArray());
}
//print_r($argc);
//print_r($argv);
//echo $choice;
echo "</pre>";
die();