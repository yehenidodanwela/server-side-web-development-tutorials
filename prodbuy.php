<?php 
include ("db.php");                         //include db.php file to connect to DB 
$pageName="a smart buy for a smart home";                   //Create and populate a variable called $pageName 
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";   //Call in stylesheet 
 
echo "<title>".$pageName."</title>";            //display name of the page as window title 
 
echo "<body>"; 
include ("headfile.html");                  //include header layout file  
 
echo "<h4>".$pageName."</h4>";              //display name of the page on the web page 
 
//retrieve the product id passed by URL from previous page using the GET method  
//it uses the $_GET superglobal variable to collect the value of the URL parameter u_prod_id 
//assign the value to a local variable called $prodId 
$prodId=$_GET['u_prod_id'];                 //see https://www.w3schools.com/php/php_superglobals_get.asp 
echo "<p>Selected product Id: ".$prodId."</p>"; //display the value of the product id, for debugging purposes.  

//create a $SQL variable and assign to it a SQL statement that retrieves product details 
$SQL="select prodId, prodName, prodPicNameLarge, prodDescripLong, prodPrice, prodQuantity from Product where prodId=".$prodId; 
 
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
    echo "<img src=images/".$arrayP['prodPicNameLarge']." height=300 width=300>"; //display large image
    echo "</a>"; //close anchor 
    echo "</td>"; 
    echo "<td style='border: 0px'>"; 
    echo "<h5>".$arrayP['prodName']."</h5>"; //display product name  
    echo "<p style='padding-left:30px;'>".$arrayP['prodDescripLong']."</p>"; //display product long description  
    echo "<p style='padding-left:30px; padding-top:20px;'><b>£".$arrayP['prodPrice']."</b></p>"; //display product price
    echo "<p style='padding-left:30px; padding-top:20px;'>Number left in stock: ".$arrayP['prodQuantity']."</p>"; //display product quantity

    echo "<p style='padding-left:0px; padding-top:20px;' class='updateInfo'>Number to be purchased: </p>"; 
    //create HTML form made of one text field and one button for user to enter required quantity 
    //the value entered in the form will be posted to the basket.php to be processed 
    echo "<form style='padding-left:30px;' action='basket.php' method='post'>";    
    //action is page to be called, method is POST 
    
    echo "<select name='prod_quantity'>";
    for ($i=1; $i<=$arrayP['prodQuantity']; $i++) {
        echo "<option value='".$i."'>".$i."</option>";
    }
    echo "</select>";

    echo "<input type='submit' name='submitbtn' value='ADD TO BASKET' id='submitbtn'>"; 
    echo "<input type='hidden' name='h_prodid' value=".$prodId.">"; //pass product id to next page basket.php as hidden value 
    echo "</p>"; 
    echo "</form>";

    echo "</td>";  
    echo "</tr>"; 
} 

echo "</table>";                            //close HTML table

mysqli_close($conn);                        //close database connection

include("footfile.html");                   //include head layout 
echo "</body>"; 

?> 