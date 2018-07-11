<?php
    session_start();
    include "db_connect.php";

    $list = mysqli_query($db, "SELECT * FROM category");
    $cat_ID = mysqli_real_escape_string($db, $_POST['cat_ID']);
    if (isset($_POST['delete']))
        $_SESSION["cat_ID"] = $cat_ID;
    $cat_name = mysqli_real_escape_string($db, $_POST['cat_name']);
?>
<?php
    if (isset($_POST['submit'])){
        $msg1 ="Category had been updated";
        $sql="UPDATE category SET cat_name = '$cat_name' WHERE cat_ID = $cat_ID";

        if (!mysqli_query($db,$sql)) {
            die('Error: ' . mysqli_error($db));
        }
        include("category.php");
    }
    if(isset($_POST['yes'])){
        $msg2 ="Category had been deleted";
        $sql="DELETE FROM category WHERE cat_ID = ".$_SESSION['cat_ID'];

        if (!mysqli_query($db,$sql)) {
            die('Error: ' . mysqli_error($db));

        }
        include("category.php");
    }
    if(isset($_POST['no'])){
        header('Location: updatecat.php');
    }
?>
<html>
<head><title>Update Category - Real Canadian Superstore</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <div id="wrapper">
        <?php include "sidebar.php" ?>
        <div id="content">
            <h2 id="page-title">Update Categories</h2>
                <form action="" method="post" name="submit">
                <p>Category ID: <input class="insert" type="varchar" name="cat_ID" required></P>
                <p>Category Name: <input class="insert" type="varchar" name="cat_name">
                </P>
                <input class="submit" type="submit" name='submit' value='submit'><span class="msg2"><?php echo $msg1;?></span>
                </form>
                <br>
                <?php
                    $list = mysqli_query($db, "SELECT * FROM category");
                ?>
                <form action="" method="post" name="delete">
                    <p>Delete Category: <input class="insert" type="varchar" name="cat_ID" placeholder="Enter Category ID"></p>
                    <input class="submit" type="submit" name="delete" value="Delete"><span class="msg2"><?php echo $msg2;?></span>
                </form>
            <br>
            <?php
                if (!isset($_POST['delete'])){
                    include("tablecat.php");
                }
                if (isset($_POST['delete'])){
                    if(!empty($_POST["cat_ID"]) && is_numeric($cat_ID)){
                        include "db_connect.php";
                        $result = mysqli_query($db, "SELECT * FROM category WHERE cat_ID = $cat_ID"); 
     
                        echo 
                        "<table id='data-table'>
                        <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        </tr>";

                        while ($row = mysqli_fetch_array($result)) {
                            if ($row['cat_ID'] % 2 == 0){
                                echo "<tr class='even'>";
                            }
                            else{
                                echo "<tr class='odd'>";
                            }
                            echo "<td>" . $row['cat_ID'] . "</td>";
                            echo "<td>" . $row['cat_name'] . "</td>";
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