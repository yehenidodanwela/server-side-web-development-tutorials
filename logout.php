<?php
session_start();

unset($_SESSION['userId']);
unset($_SESSION['userFName']);
unset($_SESSION['userSName']);
unset($_SESSION['userEmail']);

$pageName="logout";
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pageName."</title>";

echo "<body>";
include ("headfile.html");
echo "<h4>".$pageName."</h4>";

echo "<p class='updateInfo'><b>You have been logged out successfully.</b></p>";
echo "<p class='updateInfo'><a href='login.php'>Log in again</a> or <a href='index.php'>continue shopping</a>.</p>";

include("footfile.html");
echo "</body>";
?>
