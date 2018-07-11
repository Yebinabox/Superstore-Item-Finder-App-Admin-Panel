<?php $db = mysqli_connect("anneuycom.ipagemysql.com","superstore_admin","Superstore100!", "superstore_db");
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>