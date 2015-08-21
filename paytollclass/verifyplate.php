<head>
<?php session_start(); ?>
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
<h3>Next up</h3>
<h5>
    I've just got to check I've got the right vehicle. </h5>
<?php    
// Process Plate Number
$plateno = $_POST['plate'];
//$vdetailsurl = "https://tolling.nzta.govt.nz/GetVehicleInfoAndIsActiveVehicle.aspx?CountryCode=NZ&RegionCode=ANY&Captcha=&LicensePlate=$plateno";
//$vdetailsurl = "https://tollingonline.nzta.govt.nz/api/VehicleSearch/?plateNumber=$plateno&transactionType=PurchaseTrip";
$vdetailsurl = "http://toll.nos.net.nz/simulatedplate.json";
$vdetails = file_get_contents($vdetailsurl);
//echo $json;

//Check if vehicle exists
$vexistsraw = substr($vdetails, strpos($vdetails, "VehicleInfo: ") + 13);
list($vexists) = explode(",", $vexistsraw);
if ($vexists == "null"){
    echo "Whoops, your vehicle couldn't be found. Check you've got the plate number right or try one of these alternative methods:
    <ul>
    <li><a href=\"https://tolling.nzta.govt.nz/PurchaseTripPass.aspx\">online, using a web form</a></li>
    <li>over the phone on <a href=\"tel:+640800402020\">0800 40 20 20</a></li>
    <li>at a participating service station</li>";
    die();
}
//Detect Tolling Class
$class = substr($vdetails, strpos($vdetails, "OverallClass: ") + 14);
list($classno) = explode(',', $class);
//$tariffurl = "https://tolling.nzta.govt.nz/GetPrePayTripPassTariff.aspx?OverallClassID=$classno";
$tariffurl = "http://toll.nos.net.nz/fare.json";
$tariff = file_get_contents($tariffurl);

//Error if no payment is allowed
$classtarifffail = substr($tariff, strpos($tariff, "Done: ") + 6);
list($classtarifffailconf) = explode(",", $classtarifffail);
if ($classtarifffailconf == "false"){
    echo "Whoops, You cant pay your toll using this app, you'll have to use one of the following methods:
    <ul>
    <li><a href=\"https://tolling.nzta.govt.nz/PurchaseTripPass.aspx\">online, using a web form</a></li>
    <li>over the phone on <a href=\"tel:+640800402020\">0800 40 20 20</a></li>
    <li>at a participating service station</li>";
    die();
}

//Detect Tariff
$classtariff = substr($tariff, strpos($tariff, "'") + 1);
list($classtariffprice) = explode("'", $classtariff);
$classtariffprice .= "0 </b>for your ";

// Detect Make and Model
$classtype = substr($vdetails, strpos($vdetails, "OverallClassDescription: '") + 26);
list($classdescription) = explode('\'', $classtype);
$classdescription = strtolower($classdescription);
echo "<h6>I think your $classdescription is a";
$yearstring = substr($vdetails, strpos($vdetails, "Year: ") + 6);
list($year) = explode(',', $yearstring);
$year = ucfirst(strtolower($year));
echo " $year";
$colourstring = ucfirst(substr($vdetails, strpos($vdetails, "ColorDescription: '") + 19));
list($colour) = explode('\'', $colourstring);
$colour = ucfirst(strtolower($colour));
echo " $colour";
$makestring = ucfirst(substr($vdetails, strpos($vdetails, "MakeDescription: '") + 18));
list($make) = explode('\'', $makestring);
$make = ucfirst(strtolower($make));
echo " $make";
$modelstring = ucfirst(substr($vdetails, strpos($vdetails, "ModelDescription: '") + 19));
list($model) = explode('\'', $modelstring);
$model = ucfirst(strtolower($model));
echo " $model. If I'm right you can fill out the fields below and proceed with payment. </span>";
echo "</h6>";

/*
// Print Price
$classtariffprice .= "</b><span style=\"text-transform: lowercase\">$classdescription</span>";
echo "<h7>You'll need to pay <b>$$classtariffprice per trip</h7><br>";
//https://tolling.nzta.govt.nz/GetPrePayTripPassTariff.aspx?OverallClassID=2
//echo "<br> <img id=\"image\" src=\"loading-animation.gif\" style=\"width: 320px\"/>";
*/
// Collects the other details
//MakeId
$makeidraw = substr($vdetails, strpos($vdetails, "MakeId: ") + 8);
list($makeid) = explode(',', $makeidraw);
//ModelId
$modelidraw = substr($vdetails, strpos($vdetails, "ModelId: ") + 9);
list($modelid) = explode(',', $modelidraw);
//UserClassId
$userclassraw = substr($vdetails, strpos($vdetails, "UserClassId: ") + 13);
list($userclass) = explode(',', $userclassraw);
// Sets up session for handoff
$_SESSION['plate'] = $plateno;
$classtariff = substr($tariff, strpos($tariff, "'") + 1);
list($classtariffprice) = explode("'", $classtariff);
$_SESSION['tripprice'] = $classtariffprice;
$_SESSION['tripprice'] .= "0";
$_SESSION['classnumber'] = $classno;
$_SESSION['classdescription'] = $classdescription;
$_SESSION['vehiclemake'] = $make;
$_SESSION['vehiclemakeid'] = $makeid;
$_SESSION['vehiclemodel'] = $model;
$_SESSION['vehiclemodelid'] = $modelid;
$_SESSION['userclass'] = $userclass;

if ($userclassraw = "2") {
    $tdprice = "1.80";
    $ngtrprice = "2.20";
    $telprice = "2.00";
    $_SESSION['tdprice'] = "1.80";
    $_SESSION['ngtrprice'] = "2.20";
    $_SESSION['telprice'] = "2.00";
    /*echo "<script>";
    echo "window.onload = function(){ 
    document.getElementById('ngtrips').onkeyup = function() {
    var a = 2.20 * parseFloat(this.value);
    var b = Number((a).toFixed(2));
    document.getElementById(\"ngtrtotal\").innerHTML = b || 0;
    }
    }";
    echo "</script>";*/
}

?>
<div class="mdl-tooltip" style="background-color: transparent" for="image" onclick="http://www.edmunds.com/?id=apis">
<img src="100_red.png">
</div>
</h5>
<form id="priortohandoff" action="priortohandoff.php" method="post">
    <h3>How many trips do you want?</h3>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
    <input class="mdl-textfield__input" pattern="[0-9]|10" id="ngtrips" name="ngtrips" value="0" required/>
    <label class="mdl-textfield__label" for="ngtrips">Northern Gateway Toll Road ($<?php echo $ngtrprice; ?> per trip)</label>
    <span class="mdl-textfield__error">You can purchase a maximum of 10 trips.</span>
  </div><br>
    <!--<i id="ngtrtotal">$</i>-->
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
    <input class="mdl-textfield__input" pattern="[0-9]|10" id="teltrips" name="teltrips" value="0" required/>
    <label class="mdl-textfield__label" for="teltrips">Tauranga Eastern Link Toll Road ($<?php echo $telprice; ?> per trip)</label>
    <span class="mdl-textfield__error">You can purchase a maximum of 10 trips.</span>
  </div><br>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
    <input class="mdl-textfield__input" pattern="[0-9]|10" id="tdtrips" name="tdtrips" value="0" required/>
    <label class="mdl-textfield__label" for="tdtrips">Takitimu Drive Toll Road ($<?php echo $tdprice; ?> per trip)</label>
    <span class="mdl-textfield__error">You can purchase a maximum of 10 trips.</span>
  </div><br><br><br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
    <input class="mdl-textfield__input" type="email" id="email" name="email" required/>
    <label class="mdl-textfield__label" for="email">Your email address</label>
    <span class="mdl-textfield__error">Enter an email address to receive your receipt.</span>
  </div><br><br>
</form>
<button type="submit" form="priortohandoff" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  Next Step
</button><br><br><br>
</body>