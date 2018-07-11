<?php
	session_start();
	include "db_connect.php";

	$pcheck_err = "";
	$msg1 ="";
	$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$user_id = mysqli_real_escape_string($db, $_POST['user_id']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$pcheck = mysqli_real_escape_string($db, $_POST['pcheck']);
if (isset($_POST['submit'])){
	if ($password != $pcheck){
		$msg3 = "Password does not match";
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$msg2 = "Invalid Email";
	}
	if (filter_var($email, FILTER_VALIDATE_EMAIL) && $password == $pcheck){
		$msg1 ="User had been added";
		$sql="INSERT INTO users (first_name, last_name, email, password, pcheck)
		VALUES ('$first_name', '$last_name', '$email', '$password', '$pcheck')";
		if (!mysqli_query($db,$sql)) {
	  		die('Error: ' . mysqli_error($db));
		}
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['logged_in'] = true;
	}
}
?>