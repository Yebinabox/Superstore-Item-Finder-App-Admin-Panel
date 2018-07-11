<?php
	session_start();
?>
<link rel="stylesheet" type="text/css" href="style/style.css">
<div id="menu">
	<ul>
		<li>
			<a href="homepage.php">Home</a>
		</li>
		
		<li><a href="items.php">Item</a>
			<ul>
				<li>
					<a href="entitem.php">Add New Item</a>
				</li>
				<li>
					<a href="updateitem.php">Edit Item</a>
				</li>

			</ul>
		</li>

		<li><a href="products.php">Product</a>
			<ul>
				<li>
					<a href="entprod.php">Add New Product</a>
				</li>
				<li>
					<a href="updateprod.php">Edit Product</a>
				</li>
			</ul>
		</li>
		<li><a href="categories.php">Category</a>
			<ul>
				<li>
					<a href="entcat.php">Add New Category</a>
				</li>
				<li>
					<a href="updatecat.php">Edit Category</a>
				</li>
			</ul>
		</li>
<?php
	if ($_SESSION['master'] == true){
		echo 
			'<li><a href="users.php">Admin</a>
				<ul>
					<li>
						<a href="register.php">Add User</a>
					</li>
					<li>
						<a href="edituser.php">Edit User</a>
					</li>
				</ul>
			</li>';
	}
?>
		<li>
			<a href="support.php">Contact Support</a>
		</li>
		<li>
			<a href="logout.php">Logout</a>
		</li>
	</ul>
<img src="images/sb-logo.png" id="logo-sidebar" width="300"/>
</div>