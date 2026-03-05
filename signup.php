<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

include ("db.php");

$pageName="sign up";
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pageName."</title>";

$message = "";

$fName = "";
$sName = "";
$address = "";
$postcode = "";
$telNo = "";
$email = "";

if (isset($_POST['signup_submit']))
{
	$fName = trim($_POST['txtFName']);
	$sName = trim($_POST['txtSName']);
	$address = trim($_POST['txtAddress']);
	$postcode = trim($_POST['txtPostcode']);
	$telNo = trim($_POST['txtTelNo']);
	$email = trim($_POST['txtEmail']);
	$password = trim($_POST['txtPassword']);
	$confirmPassword = trim($_POST['txtConfirmPassword']);

	if ($fName=="" || $sName=="" || $address=="" || $postcode=="" || $telNo=="" || $email=="" || $password=="" || $confirmPassword=="")
	{
		$message = "<p class='updateInfo'><b>Please complete all fields.</b></p>";
	}
	elseif ($password != $confirmPassword)
	{
		$message = "<p class='updateInfo'><b>Passwords do not match.</b></p>";
	}
	else
	{
		$fName = mysqli_real_escape_string($conn, $fName);
		$sName = mysqli_real_escape_string($conn, $sName);
		$address = mysqli_real_escape_string($conn, $address);
		$postcode = mysqli_real_escape_string($conn, $postcode);
		$telNo = mysqli_real_escape_string($conn, $telNo);
		$email = mysqli_real_escape_string($conn, $email);
		$password = mysqli_real_escape_string($conn, $password);

		$checkSQL = "SELECT userId FROM `users` WHERE userEmail='".$email."'";
		$exeCheckSQL = mysqli_query($conn, $checkSQL) or die (mysqli_error($conn));

		if (mysqli_num_rows($exeCheckSQL) > 0)
		{
			$message = "<p class='updateInfo'><b>This email is already registered. Please use a different email.</b></p>";
		}
		else
		{
			$insertSQL = "INSERT INTO `users` (userType, userFName, userSName, userAddres, userPostCode, userTelNo, userEmail, userPassword) VALUES ('customer', '".$fName."', '".$sName."', '".$address."', '".$postcode."', '".$telNo."', '".$email."', '".$password."')";
			$exeInsertSQL = mysqli_query($conn, $insertSQL);

			if ($exeInsertSQL)
			{
				$message = "<p class='updateInfo'><b>Sign-up successful. You can now <a href='login.php'>log in</a>.</b></p>";

				$fName = "";
				$sName = "";
				$address = "";
				$postcode = "";
				$telNo = "";
				$email = "";
			}
			else
			{
				$message = "<p class='updateInfo'><b>Unable to create account. Please check your User table column names and try again.</b></p>";
			}
		}
	}
}

echo "<body>";
include ("headfile.html");
echo "<h4>".$pageName."</h4>";

echo $message;

echo "<div class='formStyle'>";
echo "<form id='signupform' action='signup.php' method='post'>";
echo "<div class='element'><label>First name</label><input type='text' name='txtFName' value='".htmlspecialchars($fName, ENT_QUOTES)."' required></div>";
echo "<div class='element'><label>Surname</label><input type='text' name='txtSName' value='".htmlspecialchars($sName, ENT_QUOTES)."' required></div>";
echo "<div class='element'><label>Address</label><input type='text' name='txtAddress' value='".htmlspecialchars($address, ENT_QUOTES)."' required></div>";
echo "<div class='element'><label>Postcode</label><input type='text' name='txtPostcode' value='".htmlspecialchars($postcode, ENT_QUOTES)."' required></div>";
echo "<div class='element'><label>Telephone</label><input type='text' name='txtTelNo' value='".htmlspecialchars($telNo, ENT_QUOTES)."' required></div>";
echo "<div class='element'><label>Email</label><input type='email' name='txtEmail' value='".htmlspecialchars($email, ENT_QUOTES)."' required></div>";
echo "<div class='element'><label>Password</label><input type='password' name='txtPassword' required></div>";
echo "<div class='element'><label>Confirm password</label><input type='password' name='txtConfirmPassword' required></div>";
echo "<div class='element'><label></label><input type='submit' name='signup_submit' value='SIGN UP' id='submitbtn'></div>";
echo "</form>";
echo "</div>";

include("footfile.html");
echo "</body>";

mysqli_close($conn);
?>