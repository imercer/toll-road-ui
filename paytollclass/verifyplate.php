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
$plateno = $_POST['plateno'];
$_SESSION['plate'] = $plateno;
$vehicletype = $_POST['vehicletype'];
$_SESSION['vehicletype'] = $vehicletype;
echo "I've just got to get a few more details and then I'll be able to sort everything out. </span>";

if ($vehicletype = "1") {
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
} elseif ($vehicletype = "2") {
    $tdprice = "4.80";
    $ngtrprice = "4.40";
    $telprice = "5.00";
    $_SESSION['tdprice'] = "4.80";
    $_SESSION['ngtrprice'] = "4.40";
    $_SESSION['telprice'] = "5.00";
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