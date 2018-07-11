<?php
    session_start();
    include "db_connect.php";
     
    //Replace * in the query with the column names.
    $result2 = mysqli_query($db, "SELECT * FROM saleitems AS p1 INNER JOIN saleitems AS p2 WHERE p1.item_ID = p2.item_ID"); 
     
    //Create an array
    $json_response2 = array();
     
    while ($row2 = mysqli_fetch_array($result2, MYSQL_ASSOC)) {
        $row2_array['sale_item_ID'] = $row2['sale_item_ID'];
        $row2_array['item_ID'] = $row2['item_ID'];
        $row2_array['sale_price'] = $row2['sale_price'];      
        //push the values in the array
        array_push($json_response2,$row2_array);
    }
    $json_string2 = json_encode($json_response2);
    //$json_string = stripcslashes($json_string);
    //echo json_encode($json_response);
    $file2 = 'saleitem.json';
    file_put_contents($file2, $json_string2);
     
    //Close the database connection
    mysqli_close($db);
  
?>