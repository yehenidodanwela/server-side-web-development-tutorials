<?php
session_start();
include ("db.php");

if (!isset($_POST['login_submit'])) {
    header("Location: login.php");
    exit();
}

$email = trim($_POST['txtEmail']);
$password = trim($_POST['txtPassword']);

if ($email === '' || $password === '') {
    $_SESSION['login_message'] = "<p class='updateInfo'><b>Please enter email and password.</b></p>";
    header("Location: login.php");
    exit();
}

$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

$SQL = "SELECT userId, userFName, userSName, userEmail FROM `users` WHERE userEmail='".$email."' AND userPassword='".$password."'";
$exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error($conn));

if (mysqli_num_rows($exeSQL) == 0) {
    $_SESSION['login_message'] = "<p class='updateInfo'><b>Invalid login details.</b></p>";
}
else {
    $arrayu = mysqli_fetch_assoc($exeSQL);
    $_SESSION['userId'] = $arrayu['userId'];
    $_SESSION['userFName'] = $arrayu['userFName'];
    $_SESSION['userSName'] = $arrayu['userSName'];
    $_SESSION['userEmail'] = $arrayu['userEmail'];
    $_SESSION['login_message'] = "<p class='updateInfo'><b>Welcome, ".$_SESSION['userFName']." ".$_SESSION['userSName']."! You are now logged in.</b></p>";
}

mysqli_close($conn);
header("Location: login.php");
exit();
?>
