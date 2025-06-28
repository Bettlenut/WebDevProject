<?php
session_start();
include("./database.php");

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
    <title>Product Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="stylesheet/shop.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>

<body class="bg-dark text-light">
    <?php include("./view/header.html"); ?>

    <section id="details" class="section-p1">
        <div class="prodImg">
            <img src="<?php echo htmlspecialchars($image); ?>" width="100%" id="mainImg" alt="Product Image">
        </div>
        <div class="prodDetails">
            <h2>Product Details</h2>
            <h4><?php echo htmlspecialchars($name); ?></h4>
            <h2>$<?php echo number_format($price, 2); ?></h6>
                <h6>Available Stocks: <?php echo ($quantity); ?>
            </h2>
            <form action="cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="number" name="quantity" value="1" min="1" max="<?php echo $quantity; ?>">
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
            <h4>Product Description:</h4>
            <span><?php echo nl2br(htmlspecialchars($description)); ?></span>
        </div>
    </section>
    <a href="shop.php">
        <center><button class="btns" id="btns1" style="margin-bottom: 30px;">Go Back</button></center>
    </a>

    <?php include("./view/footer.html"); ?>


    <script src="script/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>