<?php
	session_start();
	include "db_connect.php";
?>
<html>
<head><title>Categories - Real Canadian Superstore</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div id="wrapper">
		<?php include "sidebar.php" ?>
			<div id="content">
			<h2 id="page-title">Categories</h2>
			<?php
				include("tablecat.php");
			?>
		</div>
	</div>
<div class="clear" id="footer">&copy; 2014 Superstore - Powered by Bulldog Development</div>
</body>
</html>