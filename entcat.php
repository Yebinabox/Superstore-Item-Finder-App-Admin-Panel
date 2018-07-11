<?php
	session_start();
	include "db_connect.php";
	include "subcat.php";
?>
<html>
<head><title>Add New Category - Real Canadian Superstore</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div id="wrapper">
		<?php include "sidebar.php" ?>
			<div id="content">
			<h2 id="page-title">Add New Category</h2>
			<form action="" method="post" name="submit">
				<p>Category Name: <input class="insert" type="varchar" name="cat_name" required></p>
				<input class="submit" type="submit" name='submit' value='submit'><span class="msg2"><?php echo $msg1;?></span>
			</form>
			<br>
			<?php
			include("tablecat.php");
			?>
		</div>
	</div>
<div class="clear" id="footer">&copy; 2014 Superstore - Powered by Bulldog Development</div>
</body>
</html>