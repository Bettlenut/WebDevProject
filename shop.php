<?php
session_start();

$con = mysqli_connect("localhost", "batch1", "batch1", "db_webdev", "3306");

$sql = "SELECT * FROM `tbl_products`";

$result = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="stylesheet/shop.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>

<body class="bg-dark text-light">
    <?php include("view/header.html"); ?>

    <section id="hero">
        <div id="hero-content">
            <h1>Welcome to Our Shop</h1>
            <p>Discover the best deals on our products!</p>
        </div>
    </section>

    <section id="product" class="margin-side">
        <div id="product-container">
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="product-item">
                    <a href="product.php?id=<?= $row['id']; ?>" id="product-link">
                        <img src="<?= $row['productImage'] ?>" alt="">
                        <h3><?= $row['productName'] ?></h3>
                        <p><?= $row['productDescription'] ?></p>
                        <h5>₱<?= $row['price'] ?></h5>
                    </a>
                    <a href="#" ><i class="fa-solid fa-cart-shopping cart"></i></a>
                </div>
            <?php
            }
            ?>
        </div>
    </section>

    <?php include("view/footer.html"); ?>


    <script src="script/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>