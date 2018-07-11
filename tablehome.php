<?php
    session_start();
    include "db_connect.php";
     
    //Replace * in the query with the column names.
    $result = mysqli_query($db, "SELECT * FROM item"); 
    $i = 0;
    echo "<table id='data-table'>";
    echo "<tr>";
    for ($i = 0; $i < $row = mysqli_fetch_array($result); $i++){
        if ($i % 2 == 0){
            echo "<td class='odd'>";
        }
        else{
            echo "<td class='even'>";
        }
        echo "<center><img height='80px' src=" . $row['pic_url'] . "></img></center>";
        echo "<center class='brand-name'>" . $row['item_name'] . "</center>";
        echo "<center class='small'>$ " . $row['price'] . "</center>";
        echo "</td>";
        if ($i % 5 == 4){
            echo "</tr>";
            echo "<tr>";
        }

    };
    echo "</tr>"; 
    echo "</table>";
  
?>