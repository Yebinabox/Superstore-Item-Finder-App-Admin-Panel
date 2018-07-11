<?php
	session_start();
	include "db_connect.php";

	$pcheck_err = "";
	$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$user_ID = mysqli_real_escape_string($db, $_POST['user_ID']);
	if (isset($_POST['delete']))
        $_SESSION["user_ID"] = $user_ID;
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$pcheck = mysqli_real_escape_string($db, $_POST['pcheck']);
?>
<?php
	if(isset($_POST['no'])){
        header('Location: edituser.php');
    }
    if(isset($_POST['edit'])){
        if(!is_numeric($user_ID)){
            $msg3 = "Invalid ID";
        }
    }  
	if (isset($_POST['submit'])){
		if ($password != $pcheck){
			$msg1 = "Password does not match";
		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL) && $password == $pcheck){
			$msg1 = "User had been updated";
			$sql="UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password', pcheck = '$pcheck' WHERE user_ID = $user_ID";
			if (!mysqli_query($db,$sql)) {
			  	die('Error: ' . mysqli_error($db));
			}
		}
	}
?>
<html>
<head><title>Edit User - Real Canadian Superstore</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div id="wrapper">
		<?php include "sidebar.php" ?>
		<div id="content">
			<h2 id="page-title">Edit User</h2>
			<form action="" method="post" name="edit" enctype="multipart/form-data">
				<p>User ID: <input class="insert" type="varchar" name="user_ID" ><span class="msg"><?php echo $msg3;?></span></p>
				<input class="submit" type="submit" name="edit" value="Edit">
            </form><br>
            <?php
                $grabinfo = mysqli_query($db, "SELECT * FROM users WHERE user_ID = $user_ID");
                $prepop = mysqli_fetch_array($grabinfo);
            ?>
			<form action="" method="post" name="submit">
				<p>User ID: <input class="insert" type="varchar" name="user_ID" value="<?php echo $prepop['user_ID']?>" readonly></p>
				<p>First Name: <input class="insert" type="varchar" name="first_name" value="<?php echo $prepop['first_name']?>" required></p>
				<p>Last Name: <input class="insert" type="varchar" name="last_name" value="<?php echo $prepop['last_name']?>" required></p>
				<p>Email:<input class="insert" type="text" name="email" value="<?php echo $prepop['email']?>" required></p>
				<p>Password:<input class="insert" type="password" name="password" value="<?php echo $prepop['password']?>" required></p>
				<p>Re-enter Password: <input class="insert" type="password" name="pcheck"value="<?php echo $prepop['pcheck']?>"  required></p>
				<input class="submit" type="submit" name='submit' value='submit'><span class="msg2"><?php echo $msg1;?></span>
			</form>
			<br>
			<?php
				$res = mysqli_query($db, "SELECT * FROM users"); 
				if(isset($_POST['yes'])){
					$msg2 ="User had been deleted";
					$sql="DELETE FROM users WHERE user_ID = ".$_SESSION['user_ID'];
					if (!mysqli_query($db,$sql)) {
						die('Error: ' . mysqli_error($db));
					}
					include("item.php");
				}
				if(isset($_POST['no'])){
					header('Location: edituser.php');
				}	 
			?>
			<form action="" method="post" name="delete">
			    <p>Delete User: <input type="varchar" name="user_ID" placeholder="Enter User ID" required></p>
			    <input class="submit" type="submit" name="delete" value="Delete"><span class="msg"><?php echo $msg2;?></span>
			</form>
			<br>
			<?php
				if (!isset($_POST['delete'])){
					include("tableuser.php");
				}
			    if (isset($_POST['delete'])){
			    	if(!empty($_POST["user_ID"]) && is_numeric($user_ID)){
				    	include "db_connect.php";
				    	$result = mysqli_query($db, "SELECT * FROM users WHERE user_ID = $user_ID"); 
				    	echo 
					    "<table id='data-table'>
					    <tr>
					    <th>User ID</th>
					    <th>First Name</th>
					    <th>Last Name</th>
					    <th>Email</th>
					    <th>Password</th>
					    </tr>";

					    while ($row = mysqli_fetch_array($result)) {
					        if ($row['user_ID'] % 2 == 0){
					            echo "<tr class='even'>";
					        }
					        else{
					            echo "<tr class='odd'>";
					        }
					        echo "<td>" . $row['user_ID'] . "</td>";
					        echo "<td>" . $row['first_name'] . "</td>";
					        echo "<td>" . $row['last_name'] . "</td>";
					        echo "<td>" . $row['email'] . "</td>";
					        echo "<td>" . $row['password'] . "</td>";
					        echo "</tr>"; 
					    };
					    echo "</table>";
					    echo "<br><p>Are you sure?";
					    echo '<form action="" method="post" name="yes"><input class="submit" type="submit" name="yes" value="yes"></form><br>';
					    echo '<form action="" method="post" name="no"><input class="submit" type="submit" name="no" value="no"></form>';
			    	}
			    	
			    }
			?>
		</div>
	</div>
<div class="clear" id="footer">&copy; 2014 Superstore - Powered by Bulldog Development</div>
</body>
</html>
