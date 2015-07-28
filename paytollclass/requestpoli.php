<head>
<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.indigo-teal.min.css" /> 
<script src="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.min.js"></script>
<script src="/analytics.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/css/styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/iframe.css">
<style>
.mdl-button {
text-transform: initial;
}
</style>
</head>
<body style="padding-left: 5px">
<h5>
<?php
session_start();
$plateno = urlencode($_SESSION['plate']);
$classtariffprice = urlencode($_SESSION['tripprice']);
$classno = urlencode($_SESSION['classnumber']);
$classdescription = urlencode($_SESSION['classdescription']);
$make = urlencode($_SESSION['vehiclemake']);
$makeid = urlencode($_SESSION['vehiclemakeid']);
$model = urlencode($_SESSION['vehiclemodel']);
$modelid = urlencode($_SESSION['vehiclemodelid']);
$userclass = urlencode($_SESSION['userclass']);
$amount = urlencode($_SESSION['amount']);
$tripno = urlencode($_SESSION['tripno']);
$email = htmlspecialchars($_SESSION['email']);
//Get Poli URL
$poliurlrequest = "https://tolling.nzta.govt.nz/GetPoliURLForTripPass.aspx?TotalAmountPostPay=0&TotalAmountPrePay=$tripno&Amount=$amount&VehicleRegistrationMarksData_Country=NZ&VehicleRegistrationMarksData_State=ANY&VehicleRegistrationMarksData_LPN=$plateno&VehicleData_Make=$make&VehicleData_Mode=$model&VehicleData_MakeId=$makeid&VehicleData_ModelId=$modelid&VehicleData_VehicleClass=$userclass&VehicleData_TollingClass=$classno&VehicleData_TollingClassDesc=$classdescription&ContactDetails_Salutation=&ContactDetails_FamilyName=anonymous&ContactDetails_FirstName=anonymous&ContactDetails_GivenName=&ContactDetails_Email=$email&ContactDetails_PostalAddress_CountryCode=&ContactDetails_PostalAddress_CountryName=&ContactDetails_PostalAddress_RegionName=&ContactDetails_PostalAddress_RegionCode=ANY&ContactDetails_PostalAddress_CityName=&ContactDetails_PostalAddress_ZipCode=&ContactDetails_PostalAddress_StreetName=&ContactDetails_PostalAddress_StreetNumber=&ContactDetails_PostalAddress_Floor=&ContactDetails_PostalAddress_Apartment=&ContactDetails_PostalAddress_Suburb=&ContactDetails_PostalAddress_RuralDeliveryNumber=&ContactDetails_PostalAddress_POBox=&ContactDetails_PostalAddress_PrivateBag=&ContactDetails_PostalAddress_AddressLines=&CardData_CardType=&CardData_CardNumber=&CardData_ValidThrough=&CardData_HolderName=&CardData_SecurityCode=&Transactions_length=0";
echo $poliurlrequest;
$poliurlresponse = file_get_contents($poliurlrequest);
//Get URL
$poliurlraw = substr($poliurlresponse, strpos($poliurlresponse, "URL: '") + 6);
list($poliurl) = explode('\'', $poliurlraw);
//Get Token
$politokenraw = substr($poliurlresponse, strpos($poliurlresponse, "Token: '") + 8);
list($politoken) = explode('\'', $politokenraw);
//echo $poliurl;
echo "<iframe src=\"$poliurl\" style=\"width: 100%; height: 100%\"/>";
//Poli Verify
$poliverifyrequest = "https://tolling.nzta.govt.nz/GetPoliURLForTripPass.aspx?TotalAmountPostPay=0&TotalAmountPrePay=$tripno&Amount=$amount&VehicleRegistrationMarksData_Country=NZ&VehicleRegistrationMarksData_State=ANY&VehicleRegistrationMarksData_LPN=$plateno&VehicleData_Make=$make&VehicleData_Mode=$model&VehicleData_MakeId=$makeid&VehicleData_ModelId=$modelid&VehicleData_VehicleClass=$userclass&VehicleData_TollingClass=$classno&VehicleData_TollingClassDesc=$classdescription&ContactDetails_Salutation=&ContactDetails_FamilyName=anonymous&ContactDetails_FirstName=anonymous&ContactDetails_GivenName=&ContactDetails_Email=$email&ContactDetails_PostalAddress_CountryCode=&ContactDetails_PostalAddress_CountryName=&ContactDetails_PostalAddress_RegionName=&ContactDetails_PostalAddress_RegionCode=ANY&ContactDetails_PostalAddress_CityName=&ContactDetails_PostalAddress_ZipCode=&ContactDetails_PostalAddress_StreetName=&ContactDetails_PostalAddress_StreetNumber=&ContactDetails_PostalAddress_Floor=&ContactDetails_PostalAddress_Apartment=&ContactDetails_PostalAddress_Suburb=&ContactDetails_PostalAddress_RuralDeliveryNumber=&ContactDetails_PostalAddress_POBox=&ContactDetails_PostalAddress_PrivateBag=&ContactDetails_PostalAddress_AddressLines=&CardData_CardType=&CardData_CardNumber=&CardData_ValidThrough=&CardData_HolderName=&CardData_SecurityCode=&Transactions_length=0";
$poliurlresponse = file_get_contents($poliurlrequest);
https://tolling.nzta.govt.nz/VerifyPoliTransaction.aspx
Token=wCfqIXjmWYs0QdYlEHP5bIHGvVj1zq0x&Email=null */
?>