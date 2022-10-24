<?php

require('C:\xampp\htdocs\muamlah-4\libfiles\iPayPipe.php');

$myObj = new iPayPipe();
$resourcePath = 'https://locahost/muamlah-4/resource.cgn'; // Mandatory
$keystorePath = "https://loclhost/muamlah-4/key/keystore.bin"; // Mandatory
$receiptURL = "https://localhost/muamlah-4"; // Mandatory
$errorURL = "https://localhost/muamlah-4";// Mandatory
// 1 – Purchase
$action = "1"; // Mandatory
//Terminal Alias Name. Mandatory
$aliasName = "PG152500";
//Transaction Currency. Mandatory
$currency = "682";
//Optional
$language = "USA";
//Transaction Amount. Mandatory
$amount = "10.35";
//Merchant Track ID. Mandatory
$trackid = "109088888";
//User Defined Fields.
$Udf1 = "Udf1"; // Optional
$Udf2 = "Udf2"; // Optional
$Udf3 = "Udf3"; // Optional
$Udf4 = "Udf4"; // Optional
$Udf5 = "Udf5"; // Optional
//Set Values
$myObj->setResourcePath('C:\xampp\htdocs\muamlah-4\key\resource.cgn');
$myObj->setKeystorePath('C:\xampp\htdocs\muamlah-4\key\keystore.bin');

$myObj->setAlias($aliasName);
$myObj->setAction($action);
$myObj->setCurrency($currency);
$myObj->setLanguage($language);
$myObj->setResponseURL($receiptURL);
$myObj->setErrorURL($errorURL);
$myObj->setAmt($amount);
$myObj->setTrackId($trackid);
$myObj->setUdf1($Udf1);
$myObj->setUdf2($Udf2);
$myObj->setUdf3($Udf3);
$myObj->setUdf4($Udf4);
$myObj->setUdf5($Udf5);
$myObj->performPaymentInitializationHTTP();

$url = $myObj->getwebAddress();
if (trim($myObj->performPaymentInitializationHTTP()) != 0) {
    echo  $myObj->getError();
    echo("ERROR OCCURED! SEE CONSOLE FOR MORE DETAILS");
    return;
} else {
    $url = $myObj->getwebAddress();
    echo "<meta http-equiv='refresh' content='0;url=$url'>";
    }
