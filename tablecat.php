<?php
    //Create Database connection
    session_start();
    include "db_connect.php";
     
    //Replace * in the query with the column names.
    $result = mysqli_query($db, "SELECT * FROM category"); 
     
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
  
?>