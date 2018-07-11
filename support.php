<html>
<head><title>Contact Support - Real Canadian Superstore</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <div id="wrapper">
        <?php include "sidebar.php" ?>
        <div id="content">
        	<h2 id="page-title">Contact Support</h2>
        	<form action="sent.php" method="post">
			    <p>User ID: <input class="insert" type="text" name="user_ID" required/></p>
			    <p>Subject: <input class="insert" type="text" name="subject" required/></p>
			    <p>Message: <textarea id="message" name="message" placeholder="Write your message here, please." required="required"></textarea><p>  
			    <input id="msgsub" class="submit" type="submit" name='submit' value='submit'>
			</form>
        </div>
    </div>
<div class="clear" id="footer">&copy; 2014 Superstore - Powered by Bulldog Development</div>
</body>
</html>