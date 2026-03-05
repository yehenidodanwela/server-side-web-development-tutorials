<?php 
session_start(); 
 
$pageName="clear smart basket";             //Create and populate a variable called $pagename 
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";   //Call in stylesheet 
 
echo "<title>".$pageName."</title>";        //display name of the page as window title 
 
echo "<body>"; 
include ("headfile.html");                  //include header layout file  
 
echo "<h4>".$pageName."</h4>";              //display name of the page on the web page 
 
//remove all session variables 
unset($_SESSION['basket']); 
//display message "basket now cleared" 
echo "<p class='updateInfo'><b>Basket now cleared!</b></p>"; 
 
include("footfile.html");                   //include head layout 
echo "</body>"; 
?>