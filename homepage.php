<?php
	session_start();
	include "db_connect.php";
?>
<html>
<head><title>Homepage - Real Canadian Superstore</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<div id="wrapper">
	<?php include "sidebar.php" ?>
	<div id="content">
	<!-- content start-->
		<h2 id="page-title">Welcome!</h2> <!-- put your title here-->
		<?php 
			include "tablehome.php";
		?>
	</div>
	<div class="clear" id="footer">&copy; 2014 Superstore - Powered by Bulldog Development</div>
</div>
</body>
</html>