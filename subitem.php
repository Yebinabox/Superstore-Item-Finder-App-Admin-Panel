<?php
	session_start();
	include "db_connect.php";
	
	$item_name = mysqli_real_escape_string($db, $_POST['item_name']);
	$brand = mysqli_real_escape_string($db, $_POST['brand']);
	$manufacturer = mysqli_real_escape_string($db, $_POST['manufacturer']);
	$quantity = mysqli_real_escape_string($db, $_POST['quantity']);
	$price = mysqli_real_escape_string($db, $_POST['price']);
	$pic_url = "images/". $_FILES['image']['name'];
	$prod_ID = mysqli_real_escape_string($db, $_POST['prod_ID']);
	$ext = pathinfo($pic_url, PATHINFO_EXTENSION);

$unq = "SELECT item_ID FROM item WHERE item_ID = '$item_ID'";
$result = mysqli_query($db,$unq);

if (isset($_POST['submit'])){
	if(!is_numeric($price)){
		$msg2 ="Numbers only";
	}
	if(is_numeric($price)){
		$msg1 ="item had been added";
		copy($_FILES['image']['tmp_name'], $pic_url);
		$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

		$sql="INSERT INTO item (item_name, brand, manufacturer, quantity, price, image, pic_url, prod_ID)
		VALUES ('$item_name', '$brand', '$manufacturer', '$quantity', '$price', '$image', '$pic_url', '$prod_ID')";

		$item_name = "";
		$brand = "";
		$manufacturer = "";
		$quantity = "";
		$price = "";
		$prod_ID = "";

		if (!mysqli_query($db,$sql)) {
		  	die('Error: ' . mysqli_error($db));
		}
		include("item.php");
	}
	
}
?>