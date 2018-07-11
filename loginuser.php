<?php
session_start();
include "db_connect.php";

	$email_err = $password_err = $login_err = "";
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	
mysql_select_db("users");
$unq = "SELECT email, password FROM users WHERE email = '$email' AND password = '$password'";
$m = mysqli_query($db, "SELECT user_ID FROM users WHERE email = '$email' AND password = '$password'");
$master = mysqli_fetch_array($m);
$_SESSION['master'] = false;
$result = mysqli_query($db,$unq);
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if (mysqli_num_rows($result) > 0){
		if ($master['user_ID'] == 1){
			$_SESSION['logged_in'] = true;
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['master'] = true;
			echo $master['user_ID'];
			header('Location: homepage.php');
		}
		else {
			$_SESSION['logged_in'] = true;
			$_SESSION['email'] = $_POST['email'];
			header('Location: homepage.php');
		}
		
	}
}
mysqli_close($db);
?>