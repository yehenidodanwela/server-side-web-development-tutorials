<?php 
$pageName="login";                   //Create and populate a variable called $pageName 
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";   //Call in stylesheet 
 
echo "<title>".$pageName."</title>";            //display name of the page as window title 
 
echo "<body>"; 
include ("headfile.html");                  //include header layout file  
 
echo "<h4>".$pageName."</h4>";              //display name of the page on the web page 
 
//display placeholder text 
echo  
"<p class='updateInfo'>
Login functionality will be added in the next tutorial step.
</p>"; 
 
include("footfile.html");                   //include foot layout 
echo "</body>"; 
?>