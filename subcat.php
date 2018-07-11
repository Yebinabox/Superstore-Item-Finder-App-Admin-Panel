<?php
	session_start();
	include "db_connect.php";

	$cat_name = mysqli_real_escape_string($db, $_POST['cat_name']);

$unq = "SELECT cat_ID FROM category WHERE cat_ID = '$cat_ID'";
$result = mysqli_query($db,$unq);

if (isset($_POST['submit'])){
	if (!empty($_POST["cat_name"])){
		$msg1 ="Category had been added";
		$sql="INSERT INTO category (cat_name)
		VALUES ('$cat_name')";
		if (!mysqli_query($db,$sql)) {
			die('Error: ' . mysqli_error($db));
		}
		$result = "Category Added";
		include("category.php");
	}
}
?>