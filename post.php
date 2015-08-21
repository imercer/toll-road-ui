<?php
include('simple_html_dom.php');
$page = file_get_contents("http://tollingonline.nzta.govt.nz/#/purchasetrips/prerequisites", false);
echo $page;
$url = 'https://tollingonline.nzta.govt.nz/api/Order/Post';
$first = "<div request-verification-token";
$second = "</div>', true)";

function get_between($page, $first, $second) 
{ 
  $substr = substr($page, strlen($first)+strpos($page, $first), (strlen($page) - strpos($page, $second))*(-1)); 
  return $substr; 
echo $substr;
} 
// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'RequestVerificationToken' => $substr,
        'content' => '{"OrderType":"FutureTrip","Orders":"[{\"AdditionalProductDetails\":{\"TollRoad\":\"Northern Gateway\",\"RegistrationNumber\":\"SN418\",\"Make\":\"HONDA\",\"Model\":\"CIVIC 4DR LXI MAN\",\"Colour\":\"RED\",\"Year\":1994,\"TollClass\":\"Motorcycle\",\"NotifyExpiry\":false,\"ExpiryNotificationEmail\":null,\"DeclareSelect\":true},\"ItemId\":\"2\",\"CostPerItem\":2.2,\"Quantity\":2},{\"AdditionalProductDetails\":{\"TollRoad\":\"Tauranga Eastern Link\",\"RegistrationNumber\":\"SN418\",\"Make\":\"HONDA\",\"Model\":\"CIVIC 4DR LXI MAN\",\"Colour\":\"RED\",\"Year\":1994,\"TollClass\":\"Motorcycle\",\"NotifyExpiry\":false,\"ExpiryNotificationEmail\":null,\"DeclareSelect\":true},\"ItemId\":\"3\",\"CostPerItem\":2,\"Quantity\":0},{\"AdditionalProductDetails\":{\"TollRoad\":\"Takitimu Drive\",\"RegistrationNumber\":\"SN418\",\"Make\":\"HONDA\",\"Model\":\"CIVIC 4DR LXI MAN\",\"Colour\":\"RED\",\"Year\":1994,\"TollClass\":\"Motorcycle\",\"NotifyExpiry\":false,\"ExpiryNotificationEmail\":null,\"DeclareSelect\":true},\"ItemId\":\"6\",\"CostPerItem\":1.8,\"Quantity\":0}]"}',
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

var_dump($result);