<?php
    session_start();
    include "db_connect.php";
     
    //Replace * in the query with the column names.
    $result = mysqli_query($db, "SELECT * FROM item AS p1 INNER JOIN product AS p2 WHERE p1.prod_ID = p2.prod_ID"); 
     
    echo 
    "<table id='data-table'>
    <tr>
    <th>Item ID</th>
    <th>Picture</th>
    <th>Item Name</th>
    <th>Item Brand</th>
    <th>Item Manufacturer</th>
    <th>Item Quantity</th>
    <th>Item Price</th>
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
  
?>