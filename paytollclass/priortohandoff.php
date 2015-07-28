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
<h3>Almost Done</h3><h5>I'm ready to go, just check everything looks alright below and then you can proceed with your payment</h5>
<?php    
session_start();
echo "";
// Process Plate Number
$trips = $_POST['tripno'];
$email = $_POST['email'];
$plateno = strtoupper($_SESSION['plate']);
$classtariffprice = $_SESSION['tripprice'];
$classno = $_SESSION['classnumber'];
$make = ucfirst(strtolower($_SESSION['vehiclemake']));
$makeid = $_SESSION['vehiclemakeid'];
$model = ucfirst(strtolower($_SESSION['vehiclemodel']));
$modelid = $_SESSION['vehiclemodelid'];
$userclass = $_SESSION['userclass'];
$classdescription = $_SESSION['classdescription'];
$amount = $trips * $classtariffprice;
$_SESSION['amount'] = $amount;
$amount = number_format($amount, 2, '.',',');
$_SESSION['tripno'] = $trips;
$_SESSION['email'] = $email;
?>
<div id="details" style="line-height: 0.5">
<h6>Vehicle Details: <?php echo $plateno;?> (<?php echo "$make $model";?>)</h6>
<h6>Number of trips: <?php echo $trips;?></h6>
<h6>Trip Tariff: <?php echo "$" . $classtariffprice;?></h6>
<h6>Total Price: <?php echo "$" . $amount;?></h6>
</div>
<button onclick="javascript:location.href='requestpoli.php'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  Pay with Poli
</button><br><br>
<i>Here's what will happen when you click pay with poli. The entries you have submitted so far and details about your car will be sent to the NZTA site. From here they'll handle the payments and ensure everything goes through.</i>
</body>