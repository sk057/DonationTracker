#!/usr/bin/php
<?php

include_once 'includes/CharityManager.php';
include_once 'includes/DonationManager.php';
include_once 'includes/CSVManager.php';

$charityManager = new CharityManager();
$donationManager = new DonationManager();
$csvManager = new CSVManager();
echo "<pre>";
//integrate csv manager here
while(true){
    echo "1-view, 2-add, 3-edit, 4-delete, 5-new donation, 6-import file, 7-quit\n";
    $choice = (int)readline();
    if($choice>7  || $choice<1)
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
                $name = readline();
                $email = readline();
                $charityManager->addCharity($name,$email);
                break;
            }
            case 3:{
                echo "Enter ID\n";
                $id = (int)readline();
                if (array_key_exists($id,$charityManager->getCharityArray())){
                    echo "Enter new name and email\n";
                    $name = readline();
                    $email = readline();
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
                    $newDonations=$charityManager->deleteCharity($id,$donationManager->getDonationArray());
                    $donationManager->setDonationArray($newDonations);
                }
                else{
                    echo "ID does not exist\n";
                }
                break;
            }
            case 5:{
                echo "Enter donor, amount, charity ID and datetime\n";
                $donor = readline();
                $amount = (float)readline();
                $charityId = (int)readline();
                $dateString = readline();
                try {
                    $date = new DateTime($dateString);
                } catch (Exception $e) {
                    echo $e;
                    break;
                }
                if (array_key_exists($charityId,$charityManager->getCharityArray())){
                    $donationManager->addDonation($donor,$amount,$charityId,$date);
                }
                else{
                    echo "Incorrect charity ID\n";
                }
                break;
            }
            case 6:{
                echo "Enter File location\n";
                $filePath = readline();
                $charities=$csvManager->readFile($filePath);
                $charityManager->appendArray($charities);
                break;
            }
            case 7:{
                break 2;
            }
        }
    }

//var_dump($donationManager->getDonationArray());
}
echo "</pre>";
die();