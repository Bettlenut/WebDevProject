<?php
    $con = mysqli_connect("localhost", "batch1", "batch1", "db_webdev", "3306");
    if ($con->connect_error) {
        echo "Error: " . $con->connect_error;
    }
?>