<?php 
include ("db.php");                         //include db.php file to connect to DB 
$pageName="make your home smart";           //Create and populate a variable called $pageName 
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";   //Call in stylesheet 
 
echo "<title>".$pageName."</title>";        //display name of the page as window title 
 
echo "<body>"; 
include ("headfile.html");                  //include header layout file  
 
echo "<h4>".$pageName."</h4>";              //display name of the page on the web page 
 
//create a $SQL variable and assign to it a SQL statement that retrieves product details 
$SQL="select prodId, prodName, prodPicNameSmall, prodDescripShort, prodPrice from Product"; 
 
//run SQL query for connected DB or exit and display error message 
//see https://www.w3schools.com/php/func_mysqli_query.asp 
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn)); 
 
echo "<table id='indextable' style='border: 0px'>";        //create HTML table 
//create an associative array $arrayP i.e. a type of array where each key is associated with a specific value. 
//populate it with the result set i.e. the records retrieved by the executed SQL query.  
//iterate through the array. For every iteration each column name in the result set becomes a key in the array. 
//see https://www.w3schools.com/php/func_mysqli_fetch_assoc.asp 
while ($arrayP=mysqli_fetch_assoc($exeSQL))                      
{ 
    echo "<tr>"; 
    echo "<td style='border: 0px'>"; 
    echo "<a href=prodbuy.php?u_prod_id=".$arrayP['prodId'].">";  //make image into an anchor to prodbuy.php, pass product id by URL 
    echo "<img src=images/".$arrayP['prodPicNameSmall']." height=200 width=200>"; //display small image
    echo "</a>"; //close anchor 
    echo "</td>"; 
    echo "<td style='border: 0px'>"; 
    echo "<h5>".$arrayP['prodName']."</h5>"; //display product name  
    echo "<p style='padding-left:30px;'>".$arrayP['prodDescripShort']."</p>"; //display product short description  
    echo "<p style='padding-left:30px; padding-top:20px;'><b>£".$arrayP['prodPrice']."</b></p>"; //display product price  
    echo "</td>";  
    echo "</tr>"; 
} 

echo "</table>";                            //close HTML table 
 
mysqli_close($conn);                        //close database connection 
 
include("footfile.html");                   //include head layout 
echo "</body>"; 
?> 