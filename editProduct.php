<?php
session_start();
$con = mysqli_connect("localhost", "batch1", "batch1", "db_webdev", "3306");

$id = $_GET['id'];

if (isset($_POST['Save'])) {
    $id = $_POST['id'];
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];
    $uploadDir = "assets/images/products/";
    $ImgDir = $uploadDir . basename($image);

    // Upload image only if file is selected
    if (!empty($image)) {
        move_uploaded_file($tempImage, $ImgDir);
        $imageUpdate = ", productImage = '$ImgDir'";
    } else {
        $imageUpdate = "";
    }

    $sql = "UPDATE tbl_products SET 
                productName = '$productName',
                productDescription = '$productDescription',
                price = '$price',
                quantity = '$quantity'
                $imageUpdate
            WHERE id = $id";

    if (mysqli_query($con, $sql)) {
        header("Location: http://localhost/webdevproject/adminDashboard.php");
        echo "<div class='alert alert-success'>Product updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating record: " . mysqli_error($con) . "</div>";
    }
}

// Get product data
$sql = "SELECT * FROM tbl_products WHERE id = $id LIMIT 1";
$result = $con->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="stylesheet/sign.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">
    <?php include("./view/header.html"); ?>

    <div class="container" id="addProduct">
        <h1 class="form-title">Edit Product</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <div class="input-group">
                <input type="text" name="productName" id="productName" value="<?php echo $row['productName']; ?>" required>
                <label for="productName">Product Name</label>
            </div>

            <div class="input-group">
                <textarea name="productDescription" id="productDescription" rows="3" required><?php echo $row['productDescription']; ?></textarea>
                <label for="productDescription">Product Description</label>
            </div>

            <div class="input-group">
                <input type="number" name="price" id="price" step="0.01" value="<?php echo $row['price']; ?>" required>
                <label for="price">Price</label>
            </div>

            <div class="input-group">
                <input type="number" name="quantity" id="quantity" value="<?php echo $row['quantity']; ?>" required>
                <label for="quantity">Quantity</label>
            </div>

            <div class="input-group">
                <input type="file" name="image" id="image">
                <label for="image">Upload New Image (optional)</label>
            </div>

            <div class="mb-3">
                <img src="<?php echo $row['productImage']; ?>" alt="Current Image" style="max-width: 200px;">
            </div>

            <input type="submit" class="btn btn-primary" value="Save Changes" name="Save">
        </form>
    </div>

    <?php include("./view/footer.html"); ?>

    <script src="script/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
