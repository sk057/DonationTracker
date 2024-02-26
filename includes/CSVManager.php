<?php
include_once 'Charity.php';
class CSVManager
{
    function __construct() {
    }

    function readFile(string $filePath):array
    {
        $charityArray = [];
        $file_parts = pathinfo($filePath);
        if ($file_parts['extension']!="csv"){
            echo "Incorrect file extention\n";
            return $charityArray;
        }
        if (($open = fopen($filePath, "r")) !== false) {
            while (($data = fgetcsv($open, 1000, ",")) !== false) {
                if (count($data)==2){
                    try{
                        $charity = new Charity(0,$data[0],$data[1]);
                        $charityArray[]=$charity;
                    }
                    catch (Exception $e){}
                }
            }
            fclose($open);
        }
        return $charityArray;
    }
}