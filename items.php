<?php
	session_start();
	include "db_connect.php";
?>
<html>
<head><title>Items - Real Canadian Superstore</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div id="wrapper">
		<?php include "sidebar.php" ?>
			<div id="content">
			<h2 id="page-title">Items</h2>
			<?php
				include("tableitem.php");
			?>
		</div>
	</div>
<div class="clear" id="footer">&copy; 2014 Superstore - Powered by Bulldog Development</div>
</body>
</html>