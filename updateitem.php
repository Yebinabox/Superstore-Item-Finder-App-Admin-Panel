<?php
    session_start();
    include "db_connect.php";

    $list = mysqli_query($db, "SELECT * FROM product ORDER BY prod_name");
    $res = mysqli_query($db, "SELECT * FROM item");  
    $check = "";
    $item_ID = mysqli_real_escape_string($db, $_POST['item_ID']);
    if (isset($_POST['delete']))
        $_SESSION["item_ID"] = $item_ID;
    $item_name = mysqli_real_escape_string($db, $_POST['item_name']);
    $brand = mysqli_real_escape_string($db, $_POST['brand']);
    $manufacturer = mysqli_real_escape_string($db, $_POST['manufacturer']);
    $quantity = mysqli_real_escape_string($db, $_POST['quantity']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $pic_url = "images/". $_FILES['image']['name'];
    $prod_ID = mysqli_real_escape_string($db, $_POST['prod_ID']);
    $sale_price = mysqli_real_escape_string($db, $_POST['sale_price']);
    $ext = pathinfo($pic_url, PATHINFO_EXTENSION);

    if(isset($_POST['yes'])){
        $msg2 ="Item had been deleted";
        $sql="DELETE FROM item WHERE item_ID = ".$_SESSION['item_ID'];
        $sql2="DELETE FROM saleitems WHERE item_ID = ".$_SESSION['item_ID'];

        if (!mysqli_query($db,$sql)) {
            die('Error: ' . mysqli_error($db));

        }
        include("item.php");
        include("saleitem.php");
    }
    if(isset($_POST['no'])){
        header('Location: updateitem.php');
    }   
    if(isset($_POST['edit'])){
        if(!is_numeric($item_ID)){
            $msg3 = "Invalid ID";
        }
    }  
    if (isset($_POST['submit'])){
        if(is_numeric($item_ID) && is_numeric($price) && $pic_url == "images/"){
            $msg1 ="Item had been updated";
            $sql="UPDATE item SET item_name = '$item_name', brand = '$brand', manufacturer = '$manufacturer', quantity = '$quantity', price = '$price', prod_ID = '$prod_ID' 
            WHERE item_ID = $item_ID";
            echo $newname;
            if (!mysqli_query($db,$sql)) {
                die('Error: ' . mysqli_error($db));
            }
            include("item.php");
            if(!empty($sale_price) && is_numeric($sale_price)){
                $sql="INSERT INTO saleitems (item_ID, sale_price) VALUES ('$item_ID', '$sale_price')";
                $sql2="UPDATE saleitems SET item_ID = '$item_ID', sale_price = '$sale_price' WHERE item_ID = $item_ID";
            }
            include("saleitem.php");
        }
        if(is_numeric($item_ID) && is_numeric($price) && !empty($pic_url)){
            $msg1 ="Item had been updated";
            copy($_FILES['image']['tmp_name'], $pic_url);
            $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            $sql="UPDATE item SET item_name = '$item_name', brand = '$brand', manufacturer = '$manufacturer', quantity = '$quantity', price = '$price', pic_url = '$pic_url', image = '$image', prod_ID = '$prod_ID' 
            WHERE item_ID = $item_ID";
            echo $newname;
            if (!mysqli_query($db,$sql)) {
                die('Error: ' . mysqli_error($db));
            }
            include("item.php");
            if(!empty($sale_price) && is_numeric($sale_price)){
                $sql="INSERT INTO saleitems (item_ID, sale_price) VALUES ('$item_ID', '$sale_price')";
                $sql2="UPDATE saleitems SET item_ID = '$item_ID', sale_price = '$sale_price' WHERE item_ID = $item_ID";
            }
            include("saleitem.php");
        }
    }     
?>
<html>
<head><title>Update Item - Real Canadian Superstore</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <div id="wrapper">
        <?php include "sidebar.php" ?>
        <div id="content">
            <h2 id="page-title">Update Item</h2>
            <form action="" method="post" name="edit" enctype="multipart/form-data">
                <p>Item ID: <input class="insert" type="varchar" name="item_ID" placeholder="Enter Item ID"required><span class="msg"><?php echo $msg3;?></span></p>
                <input class="submit" type="submit" name="edit" value="Edit">
            </form><br>
                <?php
                    $grabinfo = mysqli_query($db, "SELECT * FROM item AS p1 INNER JOIN product AS p2 WHERE p1.prod_ID = p2.prod_ID AND item_ID = $item_ID");
                    $prepop = mysqli_fetch_array($grabinfo); 
                ?>
                    <form action="" method="post" name="submit" enctype="multipart/form-data">
                        <p>Item ID: <input class="insert" type="varchar" name="item_ID" value="<?php echo $prepop['item_ID']?>" readonly></p>
                        <p>Item Name: <input class="insert" type="varchar" name="item_name" value="<?php echo $prepop['item_name']?>" required></p>
                        <p>Item Brand: <input class="insert" type="varchar" name="brand" value="<?php echo $prepop['brand']?>" required></p>
                        <p>Item Manufacturer: <input class="insert" type="varchar" name="manufacturer" value="<?php echo $prepop['manufacturer']?>" required></p>
                        <p>Item Quantity: <input class="insert" type="varchar" name="quantity" value="<?php echo $prepop['quantity']?>" required></p>
                        <p>Item Price: <input class="insert" type="varchar" name="price" value="<?php echo $prepop['price']?>" required></p>
                        <p>Image: <input class="insert" type="file" name="image" value="<?php echo $prepop['pic_url']?>"></p>
                        <p>Product Name: 
                        <select class="insert" name="prod_ID" value="<?php echo $prepop['prod_name']?>">';
                        
                        <?php
                        $selected = '';
                            while ($row = mysqli_fetch_array($list)){

                                if($row['prod_name'] == $prepop['prod_name']) $selected = "selected";

                                echo '<option value="'.$row['prod_ID'].'" '.$selected.'>' .$row['prod_name']. '</option>';
                                $selected = '';
                            }  
                        ?>
                        </select>
                        </p>
                        <p>Sale Price: <input class="insert" type="varchar" name="sale_price" placeholder="leave blank if not on sale"></p>
                        <input class="submit" type="submit" name="submit" value="submit"><span class="msg2"><?php echo $msg1;?></span><br>
                    </form>
            <?php
                $res = mysqli_query($db, "SELECT * FROM item");  
            ?>
            <br>
            <form action="" method="post" name="delete">
                <p>Delete Item: <input class="insert" type="varchar" name="item_ID" placeholder="Enter Item ID"></p>
                <input class="submit" type="submit" name="delete" value="Delete"><span class="msg"><?php echo $msg2;?></span>
            </form>
            <br>
            <?php
                if (!isset($_POST['delete'])){
                    include("tableitem.php");
                }
                if (isset($_POST['delete'])){
                    if(!empty($_POST["item_ID"]) && is_numeric($item_ID)){
                        include "db_connect.php";
                        $result = mysqli_query($db, "SELECT * FROM item AS p1 INNER JOIN product AS p2 WHERE p1.prod_ID = p2.prod_ID AND item_ID = $item_ID"); 
     
                        echo 
                        "<table id='data-table'>
                        <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Item Brand</th>
                        <th>Item Manufacturer</th>
                        <th>Item Quantity</th>
                        <th>Item Price</th>
                        <th>Picture URL</th>
                        <th>Product Name</th>
                        </tr>";

                        while ($row = mysqli_fetch_array($result)) {
                            if ($row['item_ID'] % 2 == 0){
                                echo "<tr class='even'>";
                            }
                            else{
                                echo "<tr class='odd'>";
                            }
                            echo "<td>" . $row['item_ID'] . "</td>";
                            echo "<td><center><img height='80px' src=" . $row['pic_url'] . "></img></center></td>";
                            echo "<td>" . $row['item_name'] . "</td>";
                            echo "<td>" . $row['brand'] . "</td>";
                            echo "<td>" . $row['manufacturer'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . $row['price'] . "</td>";
                            echo "<td>" . $row['prod_name'] . "</td>";
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

