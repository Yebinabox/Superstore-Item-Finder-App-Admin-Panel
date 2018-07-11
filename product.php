<?php
    //Create Database connection
    session_start();
    include "db_connect.php";
     
    //Replace * in the query with the column names.
    $result = mysqli_query($db, "SELECT * FROM product"); 
     
    //Create an array
    $json_response = array();
     
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        $row_array['prod_ID'] = $row['prod_ID'];
        $row_array['prod_name'] = $row['prod_name'];
        $row_array['aisle_ID'] = $row['aisle_ID'];
        $row_array['shelf_ID'] = $row['shelf_ID'];
        $row_array['cat_ID'] = $row['cat_ID'];
         
        //push the values in the array
        array_push($json_response,$row_array);
    }
    $json_string = json_encode($json_response);
    //echo json_encode($json_response);
    $file = 'product.json';
    file_put_contents($file, $json_string);
     
    //Close the database connection
    mysqli_close($db);
  
?>
