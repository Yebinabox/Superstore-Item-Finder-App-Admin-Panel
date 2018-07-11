<?php
	session_start();
	include "db_connect.php";
	$list = mysqli_query($db, "SELECT * FROM category  ORDER BY cat_name ASC");
?>
<html>
<head><title>Add New Product - Real Canadian Superstore</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div id="wrapper">
		<?php 
			include "sidebar.php";
			include "subprod.php";
		?>
		<div id="content">
			<h2 id="page-title">Add New Product</h2>
			<form action="" method="post" name="submit">
			<P>Product Name: <input class="insert" type="varchar" name="prod_name" required></p>
			<P>Aisle ID: <input class="insert" type="varchar" name="aisle_ID" required></p>
			<P>Shelf ID: <input class="insert" type="varchar" name="shelf_ID" required></p>
			<P>Category ID: 
			<select class="insert" name="cat_ID" value="">
			<?php
				while ($row = mysqli_fetch_array($list)){
					echo '<option value="'.$row['cat_ID'].'">' .$row['cat_name']. '</option>';
				}
			?>
			</select></p>
			<input class="submit" type="submit" name='submit' value='submit'><span class="msg2"><?php echo $msg1;?></span>
			</form>
			<br>
			<?php
			    include("tableprod.php");
			?>
		</div>
	</div>
<div class="clear" id="footer">&copy; 2014 Superstore - Powered by Bulldog Development</div>
</body>
</html>