<?php
	session_start();
	include "db_connect.php";

	$prod_name = mysqli_real_escape_string($db, $_POST['prod_name']);
	$aisle_ID = mysqli_real_escape_string($db, $_POST['aisle_ID']);
	$shelf_ID = mysqli_real_escape_string($db, $_POST['shelf_ID']);
	$cat_ID = mysqli_real_escape_string($db, $_POST['cat_ID']);

$unq = "SELECT prod_ID FROM product WHERE prod_ID = '$prod_ID'";
$result = mysqli_query($db,$unq);

if (isset($_POST['submit'])){
	if (!empty($_POST["prod_name"])){
		$msg1 ="Product had been added";
		$sql="INSERT INTO product (prod_name, aisle_ID, shelf_ID, cat_ID)
		VALUES ('$prod_name', '$aisle_ID', '$shelf_ID', '$cat_ID')";

		if (!mysqli_query($db,$sql)) {
			die('Error: ' . mysqli_error($db));
		}
		$result = "Product Added";
		include("product.php");
	}
}

?>