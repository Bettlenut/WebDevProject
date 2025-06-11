<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pName = $_POST["pName"];
    $pDesc = $_POST["pDesc"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];
    $uploadDir = "assets/images/products/";
    $ImgDir = $uploadDir . basename($image);

    // Database connection
    $con = mysqli_connect("localhost", "batch1", "batch1", "db_webdev", "3306");

    // Check connection
    if ($con->connect_error) {
        echo "Error: " . $con->connect_error;
    } else {
        echo "Connected successfully";
    }

    // Insert query
    $sql = "INSERT INTO `tbl_products`(`productName`, `productDescription`, `price`, `quantity`, `productImage`) 
        VALUES ('$pName', '$pDesc', '$price', '$quantity', '$ImgDir')";

    if ($con->query($sql) === TRUE) {
        echo "New record created successfully";
        move_uploaded_file($tempImage, $uploadDir . $image);
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    //header("Location: http://localhost/webdevproject/login.php");

    // Close connection
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="stylesheet/sign.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="bg-dark text-white">
    <?php include("./view/header.html"); ?>

    <div class="container" id="addProduct">
        <h1 class="form-title">Add Products</h1>
        <form method="post" action="admin.php" enctype="multipart/form-data">
            <div class="input-group">
                <input type="text" name="pName" id="pName" placeholder="Product Name" required>
                <label for="contactNumber">Product Name</label>
            </div>
            <div class="input-group">
                <textarea name="pDesc" id="pDesc" placeholder="Product Description" rows="1" required></textarea>
                <label for="pDesc">Product Description</label>
            </div>
            <div class="input-group">
                <input type="number" name="price" id="price" placeholder="Price" step=".01" required>
                <label for="price">Price</label>
            </div>
            <div class="input-group">
                <input type="number" name="quantity" id="quantity" placeholder="Quantity" required>
                <label for="price">Quantity</label>
            </div>
            
            <input type="file" name="image" id="image" required>
            <label for="image">Product Image</label>
            
            <input type="submit" class="btns" value="Add" name="signUp">
        </form>
    </div>

    <?php include("./view/footer.html"); ?>

    <script src="script/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</body>

</html>