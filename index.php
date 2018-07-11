<?php
	include("loginuser.php");
?>
<html>
<head><title>Login - Real Canadian Superstore</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
<style>
#logoutmsg {
	position:absolute;
	left:50%;
	margin-left:-140px;
	bottom:40%;
	margin-bottom:-120px;
	height:100px;
	width:450px;
}
</style>
</head>
<body>

	<img src="images/logo.png" id="logo"/>
	<form action="" method="post" value="login">
		<input id="email" type="text" name="email" required placeholder="Email">
		<input id="password" type="password" name="password" required placeholder="Password">
		<button id="login" type="submit">Login</button>
		<?php
		    if ($_GET['msg']){
		       echo '<p id="logoutmsg">You have been successfully logged out!<p>';
			}
		?>
	</form>
</body>
</html>