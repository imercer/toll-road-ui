<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ScoreOnline</title>
    <link rel="stylesheet" href="/css/style.css">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <link href="http://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" type="text/css">
    <script async="" src="//www.google-analytics.com/analytics.js"></script><script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><style type="text/css"></style>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
     <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.0/material.blue_grey-indigo.min.css" /> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="/css/card.css"/>
    <link rel="stylesheet" href="/css/styles.css"/>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

    <style>
.waterfall-demo-header-nav .mdl-navigation__link:last-of-type  {
  padding-right: 0;
}
</style>
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    .ui-dialog-titlebar {
     display: none;
    }
    </style>
  <script>
  $(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      modal: true,
      minWidth: 520,
      minHeight: 420,
      open: function() {
            jQuery('.ui-widget-overlay').bind('click', function() {
                jQuery('#dialog').dialog('close');
            })
        }
    });
 
$("#opener").click( function() {   
        $("#dialog").dialog("open");
})
  });
  </script>
</head>
<body>
      <div id="dialog" title="Welcome to ScoreOnline" style="text-align: center">
          <iframe src="http://scoreonline.info/help"></iframe>
</div>
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
    <!-- Top row, always visible -->
    <div class="mdl-layout__header-row">
      <!-- Title -->   
 <span class="mdl-layout-title">Toll Road Pending Payments</span> 
              <div class="mdl-layout-spacer"></div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                  mdl-textfield--floating-label mdl-textfield--align-right">
        <label class="mdl-button mdl-js-button mdl-button--icon"
               for="waterfall-exp">

        </label>
        <div class="mdl-textfield__expandable-holder">
          <input class="mdl-textfield__input" type="text" name="sample"
                 id="waterfall-exp" />
        </div>
      </div>
    </div>
    <!-- Bottom row, not visible on scroll -->
  </header>
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--6-col">
<h2>Payments Pending</h2>
<ul style="list-style-type: none; padding: 0; margin: 0; line-height: 1.5">
<style>
li {
    margin: 0;
    padding: 0;
    list-style-type: none;
}
</style>
<?php
$conn = new mysqli('localhost', 'external', 'is@@c801', 'toll-road');
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT id, plateno, timepaid FROM `pending-payments`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<a href=\"pendingpayments.php?id=" . $row["id"] . "\"/> <h5>" . $row["plateno"] . "</h5><i>Paid:" . $row["timepaid"] . "</i> <a><br>";
     }
} else {
     echo "<br>No Pending Payments<br>";
}
$conn->close();
?>
</ul>
<br><hr>
<br>
<br>
            </div>
         <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--6-col" style="line-height: 1">
<style>
    * {
margin: 0;
    }
</style>
<?php
//Grab Player Stuff from Variable
$id = $_GET['id'];
$conn = new mysqli('localhost', 'external', 'is@@c801', 'toll-road');
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM `pending-payments` WHERE id LIKE '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<h2>" . $row["payment-email"] ."</h2><br><h3>PlateNo: </h3>" . $row["plateno"] ."<br><h3>Takatimu Drive Trips: </h3> " . $row["tdtrips"] . " <br><h3>Northern Gateway Trips: </h3>" . $row["ngtrtrips"] . " <br><h3>Tauranga Eastern Link Trips: </h3>". $row["teltrips"]. " <br><h3>Amount Paid: </h3>". $row["totalpaid"]. "<br><h3>Payment Made: </h3>". $row["timepaid"]. "";
         echo "<br><hr><br>";
         echo "<div class=\"demo-grid-ruler mdl-grid\" style=\"width: 100%; text-align: center\">";
         echo "<div class=\"mdl-cell mdl-cell--6-col\"><a href=\"complete.php?action=paid&id=$id\">Mark as Paid</a></div>";
         echo "</div>";
     }
} else {
     echo "<br>The selected payment does not exist or there was no payment selected. Select a payment from the list to try again.<br>";
}
$conn->close();
?>
    </div>
        </div>
      </main>
    </div>