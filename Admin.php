<?php
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
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="stylesheet/sign.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="bg-dark text-white">
    <section id="header">
        <a href=""><img src="assets/images/logos.png" class="logo" alt=""> Website</a>
        <div>
            <ul id="navbar">
                <li><a href="index.html">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="#">About</a></li>
                <li><a href="Login.php">Login</a></li>
                <li id="bag"><a href="#"><i class="fa-solid fa-bag-shopping"></i></a></li>
                <a href="" id="close"><i class="fa-solid fa-xmark"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </section>

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

    <footer class="section-p1">
        <div class="item">
            <div class="col">
                <h4>Contact</h4>
                <p><strong>Address: </strong> 123 Street, Sample City, Country</p>
                <p><strong>Phone: </strong> +63 987 654 3211</p>
                <p><strong>Hours: </strong> 10:00 - 18:00, Mon - Sat</p>
                <div class="socmed">
                    <h4>Follow Us:</h4>
                    <div class="icon">
                        <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/"><i class="fab fa-x-twitter"></i></a>
                        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.pinterest.com/"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
            </div>
            <div class="col apps">
                <h4>Install Our App</h4>
                <p>From App Store or Google Play</p>
                <div class="row-foot">
                    <a href="https://www.apple.com/ph/app-store/"><img src="assets/images/pay/AppStore.png" alt=""></a>
                    <a href="https://play.google.com/store/games?hl=en&pli=1"><img src="assets/images/pay/PlayStore.png"
                            alt=""></a>
                </div>
                <p>Secured Payement Gateways</p>
                <img src="assets/images/pay/pay.png" alt="">
            </div>
        </div>
        <p>©2025, Miku - Web Development NCIII Project</p>
    </footer>

    <script src="script/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</body>

</html>