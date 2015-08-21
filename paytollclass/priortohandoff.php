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
<h3>Almost Done</h3><h5>Have a look at everything before proceeding to make your payment</h5>
<?php    
session_start();
echo "";
// Get number of trips
$ngtrtrips = $_POST['ngtrips'];
$teltrips = $_POST['teltrips'];
$tdtrips = $_POST['tdtrips'];

$totaltrips = $ngtrtrips + $teltrips + $tdtrips;

if ($totaltrips < "1") {
    echo "<h6>You Didn't Select any trips, lets head back and try again</h6>";
    echo "<button onclick=\"javascript:location.href='/tollflownumberplate.html'\" class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect\">
  Go Back
</button>";
    exit ();
}
$email = $_POST['email'];
// Get prices for each toll road
$tdprice = $_SESSION['tdprice'];
$ngtrprice = $_SESSION['ngtrprice'];
$telprice = $_SESSION['telprice'];

// Work out amounts
$tdtotal = $tdtrips * $tdprice;
$tdtotal = number_format($tdtotal, 2, '.',',');
$teltotal = $teltrips * $telprice;
$teltotal = number_format($teltotal, 2, '.',',');
$ngtrtotal = $ngtrtrips * $ngtrprice;
$ngtrtotal = number_format($ngtrtotal, 2, '.',',');
$amount = $tdtotal + $teltotal + $ngtrtotal;
$_SESSION['amount'] = $amount;
$amount = number_format($amount, 2, '.',',');

// Work out Service Fee
$amountincl = $amount + 0.30 * 1.030;
$amountincl = number_format($amountincl, 2, '.',',');
$servicefee = $amountincl - $amount;
$servicefee = number_format($servicefee, 2, '.',',');

//Get the vehicle details from session
$plateno = strtoupper($_SESSION['plate']);
$classtariffprice = $_SESSION['tripprice'];
$classno = $_SESSION['classnumber'];
$make = ucfirst(strtolower($_SESSION['vehiclemake']));
$makeid = $_SESSION['vehiclemakeid'];
$model = ucfirst(strtolower($_SESSION['vehiclemodel']));
$modelid = $_SESSION['vehiclemodelid'];
$userclass = $_SESSION['userclass'];
$classdescription = $_SESSION['classdescription'];
?>
<div id="details" style="line-height: 0.5">
<h6>Vehicle Details: <?php echo $plateno;?> (<?php echo "$make $model";?>)</h6>
    
    <h6>Number of trips: </h6>
    <h7><b>Northern Gateway Toll Road:</b> <?php echo $ngtrtrips;?> <i>($<?php echo $ngtrtotal; ?> total)</i></h7><br><br><br>
    <h7><b>Takatimu Drive Toll Road:</b> <?php echo $tdtrips;?> <i>($<?php echo $tdtotal; ?> total)</i></h7><br><br><br>
    <h7><b>Tauranga Eastern Link Toll Road:</b> <?php echo $teltrips;?> <i>($<?php echo $teltotal; ?> total)</i></h7><br><br><br>
    <h6></h6>
<h6>Toll Price: <?php echo "$" . $amount;?></h6>
<h7>Service Fee: <?php echo "$" . $servicefee; ?></h7>
<h5>Total Price: <?php echo "$" . $amountincl; ?></h5>
</div>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="paypal" id="paypal" target="_top">
    <!-- Prepopulate the PayPal checkout page with customer details, -->
    <input type="hidden" name="first_name" value="Toll">
    <input type="hidden" name="last_name" value="Road">
    <input type="hidden" name="email" value="<?php $email ?>">
    <input type="hidden" name="address1" value="123 Demo Street">
    <input type="hidden" name="address2" value="">
    <input type="hidden" name="city" value="Auckland">
    <input type="hidden" name="zip" value="1030">
    <input type="hidden" name="day_phone_a" value="">
    <input type="hidden" name="day_phone_b" value="">

    <!-- We don't need to use _ext-enter anymore to prepopulate pages -->
    <!-- cmd = _xclick will automatically pre populate pages -->
    <!-- More information: https://www.x.com/docs/DOC-1332 -->
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="hosted_button_id" value="DHCMAXL7B83XL">
    <input type="hidden" name="currency_code" value="NZD">
    <input type="hidden" name="business" value="isaac@nos.net.nz">
    
    <!-- Allow the customer to enter the desired quantity -->
    <input type="hidden" name="item_name" value="Toll Road Payment" />
    <input type="hidden" name="quantity" value="1" />
    <input type="hidden" name="amount" value="<?php echo $amountincl ?>">


    <!-- Custom value you want to send and process back in the IPN -->
    <input type="hidden" name="custom" value="<?php echo session_id(); ?>" />

    <input type="hidden" name="shipping" value="" />
    <input type="hidden" name="invoice" value="" />
    <input type="hidden" name="return" value="http://<?php echo $_SERVER['SERVER_NAME']?>/pay.php?complete"/>
    <input type="hidden" name="cancel_return" value="http://<?php echo $_SERVER['SERVER_NAME']?>/pay.php?error" />

    <!-- Where to send the PayPal IPN to. -->
    <input type="hidden" name="notify_url" value="http://<?php echo $_SERVER['SERVER_NAME']?>/shop/paypal/process" />
    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
    <!--<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="DHCMAXL7B83XL">
<table>
<tr><td><input type="hidden" name="on0" value="Toll Roads">Toll Roads</td></tr><tr><td><select name="os0">
	<option value="Northern Gateway Toll Road">Northern Gateway Toll Road $2.50 NZD</option>
	<option value="Takatimu Drive Toll Road">Takatimu Drive Toll Road $2.20 NZD</option>
	<option value="Tauranga Eastern Link Toll Road">Tauranga Eastern Link Toll Road $2.40 NZD</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="NZD">
<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>-->
<!--
<button onclick="javascript:location.href='requestpoli.php'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  Pay with Poli
</button>--><br><br>
<i>It may take up to 72 hours for your tolls to appear in your account, thats why its a good idea to pay before travelling, you'll receive a receipt from the NZTA once it goes through.</i>
</body>