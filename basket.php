<?php 
session_start();

include("db.php");
$pageName="smart basket";                   //Create and populate a variable called $pageName 
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";   //Call in stylesheet 
 
echo "<title>".$pageName."</title>";            //display name of the page as window title 
 
echo "<body>"; 
include ("headfile.html");                  //include header layout file  
 
echo "<h4>".$pageName."</h4>";              //display name of the page on the web page 

if (isset($_POST['h_prodid']) && isset($_POST['prod_quantity'])) 
{
    $newProdId = (int)$_POST['h_prodid'];
    $requQuantity = (int)$_POST['prod_quantity'];
    
    //display random text 
    if ($newProdId > 0 && $requQuantity > 0)
    {
        echo "<p class='updateInfo'>Id of selected product: ".$newProdId."</p>";
        echo "<p class='updateInfo'>Quantity of selected product: ".$requQuantity."</p>"; 

        $_SESSION['basket'][$newProdId] = $requQuantity; 
        echo "<p class='updateInfo'><b>Item added to basket</b></p>";
    }
    else
    {
        echo "<p class='updateInfo'><b>Invalid product or quantity.</b></p>";
    }
}
else 
{ 
    //display a message "Basket unchanged ". 
    echo "<p class='updateInfo'><b>Basket unchanged</b></p>"; 
} 

$total= 0;  //create a variable $total and initialize it to zero 
//create HTML table with header to display the content of the basket: prod name, price, selected quantity and subtotal 
echo "<p><table id='baskettable'>"; 
echo "<tr>"; 
echo "<th>Product Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th>"; 
echo "</tr>"; 
//if the session array $_SESSION['basket'] is set 
if (isset($_SESSION['basket'])) 
{ 
    //iterate through the associative array for the session with a FOR EACH LOOP & for each data item in the array: 
    //retrieve the product ID and assign it to a variable $key 
    //retrieve the quantity and assign it to a variable $value   
    foreach($_SESSION['basket'] as $key => $value)      //see https://www.w3schools.com/php/php_looping_foreach.asp 
    { 
            $prodId = (int)$key;
            $qty = (int)$value;

            if ($prodId <= 0 || $qty <= 0)
            {
                continue;
            }

            //create a SQL query to retrieve from Product table, the details of the selected product for which ID matches $key 
            //execute query and retrieve results in associative array arrayProd 
            $SQL="select prodId, prodName, prodPrice from Product where prodId=".$prodId; 
            $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn)); 
            $arrayProd=mysqli_fetch_assoc($exeSQL); 

            if (!$arrayProd)
            {
                continue;
            }

            echo "<tr>"; 
            //display product name and product price using array of records $arrayProd. 
            echo "<td>".$arrayProd['prodName']."</td>"; 
            echo "<td>&pound;".number_format($arrayProd['prodPrice'],2)."</td>"; 
            //display selected quantity of product retrieved from the current iteration of the session array and now in $value. 
            echo "<td style='text-align:center;'>".$qty."</td>"; 
            //calculate subtotal, assign it to a local variable $subtotal and display it. 
            $subtotal=$arrayProd['prodPrice'] * $qty; 
            echo "<td>&pound;".number_format($subtotal,2)."</td>"; 
            echo "</tr>"; 
            //increase total by adding the subtotal to the current total 
            $total=$total+$subtotal; 
    } 
} 
 
//else display empty basket message 
else  
{ 
    echo " <p class='updateInfo'><b>Empty basket</b></p>"; 
} 
 
// Display total 
echo "<tr>"; 
echo "<td colspan=3><b>TOTAL</b></td>"; 
echo "<td><b>&pound;".number_format($total,2)."</b></td>"; 
echo "</tr>"; 
echo "</table>"; 
 
mysqli_close($conn);                        //close database connection

//create anchor to call clearbasket.php to clear basket 
echo "<br><p class='updateInfo'><a href='clearbasket.php'>CLEAR BASKET</a></p>"; 

include("footfile.html");                   //include head layout 
echo "</body>"; 
?> 