<?php
session_start();
echo "
<head>
<link rel=\"stylesheet\" href=\"https://storage.googleapis.com/code.getmdl.io/1.0.1/material.indigo-teal.min.css\" /> 
<script src=\"https://storage.googleapis.com/code.getmdl.io/1.0.1/material.min.js\"></script>
<link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/icon?family=Material+Icons\">
<style>
.mdl-button {
text-transform: initial;
}
</style>
</head>
<body style=\"padding-left: 5px;\">
    <h3>I've just got to confirm you are who you say you are</h3><h6>Please fill out the form below to check if you're eligible for your free upgrade.</h6>
        <form action=\"contact.php\" method=\"post\">
            <h3>Name:</h3><p>
            <input type=\"text\" name=\"name\" required><p>
            <h3>Apple ID Email Address:</h3><p>
            <input type=\"email\" name=\"mail\" required><p>
            <h3>Date you purchased Northern Gateway Toll Road:</h3><p>
            <i>If you're not too sure just check your email for a receipt or have a look in your iTunes purchase history</i><p>
            <input type=\"date\" name=\"purchasedate\" required><p>
	    <p><br>
";
require('scaptcha.php'); 
echo $_SESSION['sentence']." ".$_SESSION['num1']." ".$_SESSION['operand']." ".$_SESSION['num2']." ? ";
echo "	    <input type=\"text\" name=\"answer\" id=\"answer\" size=\"5\" />
	    <p>
            <input type=\"submit\" value=\"Submit\">
            <br>
        </form>
</body>";
