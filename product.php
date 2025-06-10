<?php
$con = new mysqli("localhost", "batch1", "batch1", "db_webdev", 3306);

// Validate and sanitize input
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid product ID.");
}

$product_id = intval($_GET['id']);

$result = $con->prepare("SELECT productName, productDescription, price, quantity, productImage FROM tbl_products WHERE id = ?");
$result->bind_param("i", $product_id);
$result->execute();
$result->store_result();

if ($result->num_rows === 0) {
    die("Product not found.");
}

$result->bind_result($name, $description, $price, $quantity, $image);
$result->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="stylesheet/shop.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>

<body class="bg-dark text-light">
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

    <section id="details" class="section-p1">
        <div class="prodImg">
            <img src="<?php echo htmlspecialchars($image); ?>" width="100%" id="mainImg" alt="Product Image">
        </div>
        <div class="prodDetails">
            <h6>Product Details</h6>
            <h4><?php echo htmlspecialchars($name); ?></h4>
            <h2>₱<?php echo number_format($price, 2); ?></h2>
            <input type="number" value="1" min="1" max="<?php echo $quantity; ?>">
            <button class="btns">Add to Cart</button>
            <h4>Product Description</h4>
            <span><?php echo nl2br(htmlspecialchars($description)); ?></span>
        </div>
    </section>
    <a href="shop.php"><center><button class="btns" id="btns1" style="margin-bottom: 30px;">Go Back</button></center></a>


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
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>