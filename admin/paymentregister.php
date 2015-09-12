<?php
//print_r($_GET);
//print_r($_POST); 
//$payer_id = $_POST['payer_id'];

//TODO: Need to get the toll type, license plate and the trip numbers
$plateno = $_GET['plateno'];
$ngtrtrips = $_GET['ngtrtrips'];
$teltrips = $_GET['teltrips'];
$tdtrips = $_GET['tdtrips'];
$email = $_GET['email'];

$servername = "localhost";
$username = "root";
$password = "is@@c801";
$dbname = "toll-road";
/*
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT payer_id FROM `users` WHERE user_email LIKE '$payer_mail'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
         $payer = $row['payer_id'];
    }
} else {
        $payer = "unregistered";
}
$conn->close();
*/
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "INSERT INTO `pending-payments` 
                (`plateno`, 
                `payment-email`, 
                `ngtrtrips`,
                `teltrips`,
                `tdtrips`) 
            VALUES (
                '$plateno', 
                '$email',
                '$ngtrtrips',
                '$teltrips',
                '$tdtrips');";
    if ($conn->query($sql) === TRUE) {
             echo "Payment Registered";
    } else {
            die("Payment Not Registered" . $conn->error);
    }
    $conn->close();
?>