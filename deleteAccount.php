<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $con = mysqli_connect("localhost", "batch1", "batch1", "db_webdev", "3306");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM tbl_accounts WHERE id = $id";

    if (mysqli_query($con, $sql)) {
        header("Location: http://localhost/webdevproject/adminDashboard.php");
    } else {
        echo "Error deleting account: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    echo "No ID provided.";
}
?>
