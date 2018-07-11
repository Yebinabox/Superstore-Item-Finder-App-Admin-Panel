<?php
    session_start();
    include "db_connect.php";
     
    //Replace * in the query with the column names.
    $result = mysqli_query($db, "SELECT * FROM product AS p1 INNER JOIN category AS p2 WHERE p1.cat_ID = p2.cat_ID"); 
     
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
  
?>