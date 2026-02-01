<?php 
 
//see https://www.w3schools.com/php/func_mysqli_connect.asp 
//see https://www.cloudways.com/blog/connect-mysql-with-php/  
 
$dbhost = '127.0.0.1';   // or 'localhost'
$dbuser = 'root';
$dbpass = '';
$dbname = 'homteq'; 
 
//create a DB connection  
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 
//if the DB connection fails, display an error message and exit 
if (!$conn) 
{ 
  die('Could not connect: ' . mysqli_error($conn)); 
}
else{
//select the database 
mysqli_select_db($conn, $dbname);
echo "connected";
}
?>
