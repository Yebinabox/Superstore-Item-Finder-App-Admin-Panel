<?php
    session_start();
    include "db_connect.php";
     
    //Replace * in the query with the column names.
    $result = mysqli_query($db, "SELECT * FROM item"); 
     
    //Create an array
    $json_response = array();
     
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        $row_array['item_ID'] = $row['item_ID'];
        $row_array['item_name'] = $row['item_name'];
        $row_array['brand'] = $row['brand'];
        $row_array['manufacturer'] = $row['manufacturer'];
        $row_array['quantity'] = $row['quantity'];
        $row_array['price'] = $row['price'];
        $row_array['pic_url'] = $row['pic_url'];
        $row_array['prod_ID'] = $row['prod_ID'];
         
        //push the values in the array
        array_push($json_response,$row_array);
    }
    $json_string = json_encode($json_response);
    //$json_string = stripcslashes($json_string);
    //echo json_encode($json_response);
    $file = 'item.json';
    file_put_contents($file, $json_string);
     
    //Close the database connection
    mysqli_close($db);
  
?>
<?php
    session_start();
    include "db_connect.php";
     
    //Replace * in the query with the column names.
    $result = mysqli_query($db, "SELECT * FROM saleitems"); 
     
    //Create an array
    $json_response = array();
     
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        $row_array['sale_item_ID'] = $row['sale_item_ID'];
        $row_array['item_ID'] = $row['item_ID'];
         
        //push the values in the array
        array_push($json_response,$row_array);
    }
    $json_string = json_encode($json_response);
    //$json_string = stripcslashes($json_string);
    //echo json_encode($json_response);
    $file = 'saleitem.json';
    file_put_contents($file, $json_string);
     
    //Close the database connection
    mysqli_close($db);
  
?>