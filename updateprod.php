<?php
    session_start();
    include "db_connect.php";

    $list = mysqli_query($db, "SELECT * FROM category ORDER BY cat_name ASC");
    $res = mysqli_query($db, "SELECT * FROM product");  
    $prod_ID = mysqli_real_escape_string($db, $_POST['prod_ID']);
    if (isset($_POST['delete']))
        $_SESSION["prod_ID"] = $prod_ID;
    $prod_name = mysqli_real_escape_string($db, $_POST['prod_name']);
    $aisle_ID = mysqli_real_escape_string($db, $_POST['aisle_ID']);
    $shelf_ID = mysqli_real_escape_string($db, $_POST['shelf_ID']);
    $cat_ID = mysqli_real_escape_string($db, $_POST['cat_ID']);

    if(isset($_POST['yes'])){
        $msg2 ="Product had been deleted";
        $sql="DELETE FROM product WHERE prod_ID = ".$_SESSION['prod_ID'];

        if (!mysqli_query($db,$sql)) {
            die('Error: ' . mysqli_error($db));

        }
        include("product.php");
    }
    if(isset($_POST['edit'])){
        if(!is_numeric($prod_ID)){
            $msg3 = "Invalid ID";
        }
    }  
    if(isset($_POST['no'])){
        header('Location: updateprod.php');
    }
    if (isset($_POST['submit'])){
        $msg1 ="Product had been updated";
        $sql="UPDATE product SET prod_name = '$prod_name', aisle_ID = '$aisle_ID', shelf_ID = '$shelf_ID', cat_ID = '$cat_ID' WHERE prod_ID = $prod_ID";

        if (!mysqli_query($db,$sql)) {
            die('Error: ' . mysqli_error($db));
        }
        include("product.php");
    }     
?>
<html>
<head><title>Update Product - Real Canadian Superstore</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <div id="wrapper">
        <?php include "sidebar.php" ?>
        <div id="content">
            <h2 id="page-title">Update Products</h2>
            <form action="" method="post" name="edit" enctype="multipart/form-data">
                <p>Product ID: <input class="insert" type="varchar" name="prod_ID" placeholder="Enter Product ID" required><span class="msg"><?php echo $msg3;?></span></p>
                <input class="submit" type="submit" name="edit" value="Edit">
            </form><br>
            <?php
                $grabinfo = mysqli_query($db, "SELECT * FROM product AS p1 INNER JOIN category AS p2 WHERE p1.cat_ID = p2.cat_ID AND prod_ID = $prod_ID");
                $prepop = mysqli_fetch_array($grabinfo);
            ?>
            <form action="" method="post" name="submit">
                <p>Product ID: <input class="insert" type="varchar" name="prod_ID" value="<?php echo $prepop['prod_ID']?>" readonly></p>
                <p>Product Name: <input class="insert" type="varchar" name="prod_name" value="<?php echo $prepop['prod_name']?>" required></p>
                <p>Aisle ID: <input class="insert" type="varchar" name="aisle_ID" value="<?php echo $prepop['aisle_ID']?>" required></p>
                <p>Shelf ID: <input class="insert" type="varchar" name="shelf_ID" value="<?php echo $prepop['shelf_ID']?>" required></p>
                <p>Category Name: 
                <select class="insert" name="cat_ID" value="">
                <?php
                    
                    if($row['cat_name'] == $prepop['cat_name']) $selected = "selected";
                    while ($row = mysqli_fetch_array($list)){
                        echo '<option value="'.$row['cat_ID'].'"'.$selected.'>' .$row['cat_name']. '</option>';
                    $selected = '';
                    }
                ?>
                </select>
                </p>
                <input class="submit" type="submit" name='submit' value='submit'><span class="msg2"><?php echo $msg1;?></span>
            </form>
            <?php
                $res = mysqli_query($db, "SELECT * FROM product");  
            ?>
            <br>
            <form action="" method="post" name="delete">
                <p>Delete Product: <input class="insert" type="varchar" name="prod_ID" placeholder="Enter Product ID"></p>
                <input class="submit" type="submit" name="delete" value="Delete"><span class="msg2"><?php echo $msg2;?></span>
            </form>
            <br>
            <?php
                if (!isset($_POST['delete'])){
                    include("tableprod.php");
                }
                if (isset($_POST['delete'])){
                    if(!empty($_POST["prod_ID"]) && is_numeric($prod_ID)){
                        include "db_connect.php";
                        $result = mysqli_query($db, "SELECT * FROM product AS p1 INNER JOIN category AS p2 WHERE p1.cat_ID = p2.cat_ID AND prod_ID = $prod_ID"); 
     
                        echo 
                        "<table id='data-table'>
                        <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Aisle ID</th>
                        <th>Shelf ID</th>
                        <th>Category Name</th>
                        </tr>";

                        while ($row = mysqli_fetch_array($result)) {
                            if ($row['prod_ID'] % 2 == 0){
                                echo "<tr class='even'>";
                            }
                            else{
                                echo "<tr class='odd'>";
                            }
                            echo "<td>" . $row['prod_ID'] . "</td>";
                            echo "<td>" . $row['prod_name'] . "</td>";
                            echo "<td>" . $row['aisle_ID'] . "</td>";
                            echo "<td>" . $row['shelf_ID'] . "</td>";
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


