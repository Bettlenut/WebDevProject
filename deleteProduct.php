<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include("./database.php");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM tbl_products WHERE id = $id";

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
