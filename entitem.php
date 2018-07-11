<?php 
	session_start();
	include "db_connect.php";
	$list = mysqli_query($db, "SELECT * FROM product ORDER BY prod_name ASC");	
?>
<html>
<head><title>Add New Item - Real Canadian Superstore</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div id="wrapper">
		<?php 
			include "sidebar.php";
			include "subitem.php";
		?>
		<div id="content">
			<h2 id="page-title">Add New Item</h2>
			<form action="" method="post" name="submit" enctype="multipart/form-data">
			<p>Item Name: <input class="insert" type="varchar" name="item_name" value="<?php echo $item_name;?>" required></p>
			<p>Item Brand: <input class="insert" type="varchar" name="brand" value="<?php echo $brand;?>" required></p>
			<p>Item Manufacturer: <input class="insert" type="varchar" name="manufacturer" value="<?php echo $manufacturer;?>" required></p>
			<p>Item Quantity: <input class="insert" type="varchar" name="quantity" value="<?php echo $quantity;?>" required></p>
			<p>Item Price: <input class="insert" type="varchar" name="price" value="<?php echo $price;?>" required><span class="msg"><?php echo $msg2;?></span></p>
			<p>Image: <input class="insert" type="file" name="image" value="<?php echo $pic_url;?>" required>
			<p>Product name: 
			<select class="insert" name="prod_ID" value="">
			<?php
				$grabinfo = mysqli_query($db, "SELECT * FROM item AS p1 INNER JOIN product AS p2 WHERE p1.prod_ID = p2.prod_ID AND item_ID = $item_ID");
                $prepop = mysqli_fetch_array($grabinfo); 

				while ($row = mysqli_fetch_array($list)){
					if($row['prod_ID'] == $prod_ID) $selected = "selected";
					echo '<option value="'.$row['prod_ID'].'"'.$selected.'>' .$row['prod_name']. '</option>';
					$selected = '';
				}
			?>
			</select>
			</p>
			<input class="submit" type="submit" name='submit' value='submit'><span class="msg2"><?php echo $msg1;?></span>
			</form>
			<br>
			<?php
			    include("tableitem.php");
			?>
		</div>
	</div>
<div class="clear" id="footer">&copy; 2014 Superstore - Powered by Bulldog Development</div>
</body>
</html>