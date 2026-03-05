<?php
session_start();

$pageName="login";
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pageName."</title>";

$message = "";
if (isset($_SESSION['login_message'])) {
	$message = $_SESSION['login_message'];
	unset($_SESSION['login_message']);
}

echo "<body>";
include ("headfile.html");
echo "<h4>".$pageName."</h4>";

echo $message;

if (!isset($_SESSION['userId'])) {
	echo "<div class='formStyle loginStyle'>";
	echo "<form action='login_process.php' method='post'>";
	echo "<div class='element'><label>Email</label><input type='email' name='txtEmail' required></div>";
	echo "<div class='element'><label>Password</label><input type='password' name='txtPassword' required></div>";
	echo "<div class='element'><label></label><input type='submit' name='login_submit' value='LOG IN' id='submitbtn'></div>";
	echo "</form>";
	echo "</div>";
}
else {
	echo "<p class='updateInfo'>Logged in as <b>".$_SESSION['userEmail']."</b></p>";
}

include("footfile.html");
echo "</body>";
?>