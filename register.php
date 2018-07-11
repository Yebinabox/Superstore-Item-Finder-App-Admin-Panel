<?php
	include("registeruser.php");
?>
<html>
<head><title>Add New User - Real Canadian Superstore</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <div id="wrapper">
        <?php include "sidebar.php" ?>
        <div id="content">
        	<h2 id="page-title">Add New User</h2>
			<form action="" method="post">
				<p>First Name: <input class="insert" type="varchar" name="first_name" required></p>
				<p>Last Name: <input class="insert" type="varchar" name="last_name" required></p>
				<p>Email:<input class="insert" type="text" name="email" required><span class="msg"><?php echo $msg2;?></span></p>
				<p>Password:<input class="insert" type="password" name="password" required></p>
				<p>Re-enter Password: <input class="insert" type="password" name="pcheck" required><span class="msg"><?php echo $msg3;?></span></p>
				<input class="submit" type="submit" name='submit' value='submit'><span class="msg2"><?php echo $msg1;?></span>
			</form>
			<br>
			<?php
			    include("tableuser.php");
			?>
		</div>
	</div>
<div class="clear" id="footer">&copy; 2014 Superstore - Powered by Bulldog Development</div>
</body>
</html>