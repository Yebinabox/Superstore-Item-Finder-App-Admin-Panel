<?php
    //Create Database connection
    session_start();
    include "db_connect.php";
     
    //Replace * in the query with the column names.
    $result = mysqli_query($db, "SELECT * FROM users"); 
     
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
  
?>