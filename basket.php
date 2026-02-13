<?php 
include("db.php");
$pageName="smart basket";                   //Create and populate a variable called $pageName 
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";   //Call in stylesheet 
 
echo "<title>".$pageName."</title>";            //display name of the page as window title 
 
echo "<body>"; 
include ("headfile.html");                  //include header layout file  
 
echo "<h4>".$pageName."</h4>";              //display name of the page on the web page 

$newProdId = $_POST['h_prodid'];
$requQuantity = $_POST['prod_quantity'];
 
//display random text 
echo  
"<p>Id of selected product: ".$newProdId."</p>
<p>Quantity of selected product: ".$requQuantity."</p>"; 
 
include("footfile.html");                   //include head layout 
echo "</body>"; 
?> 