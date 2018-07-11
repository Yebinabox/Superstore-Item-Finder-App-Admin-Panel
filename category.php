<?php
    //Create Database connection
    $db = mysqli_connect("anneuycom.ipagemysql.com","superstore_admin","Superstore100!", "superstore_db");
    
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
     
    //Replace * in the query with the column names.
    $result = mysqli_query($db, "SELECT * FROM category"); 
     
    //Create an array
    $json_response = array();
     
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        $row_array['cat_ID'] = $row['cat_ID'];
        $row_array['cat_name'] = $row['cat_name'];
        
        //push the values in the array
        array_push($json_response,$row_array);
    }
    $json_string = json_encode($json_response);
    //echo json_encode($json_response);
    $file = 'category.json';
    file_put_contents($file, $json_string);
     
    //Close the database connection
    mysqli_close($db);
  
?>
