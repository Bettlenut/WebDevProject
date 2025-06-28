<?php
session_start();

include("./database.php");

$sql = "SELECT * FROM `tbl_products`";

$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="stylesheet/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>

<body class="bg-dark text-light">
    <?php include("./view/header.html"); ?>

    <section id="hero">
        <div class="container py-6">
            <div class="row flex-lg-row-reverse align-items-center g-5">
                <div class="col-10 mx-auto col-sm-8 col-lg-6">
                    <div id="carouselAutoplay" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $folder = 'assets/images/carousel/';
                            $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                            $files = array_diff(scandir($folder), ['.', '..']);
                            $active = true;

                            foreach ($files as $file) {
                                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                if (in_array($ext, $allowed_types)) {
                            ?>
                                    <div class="carousel-item <?php if ($active) { echo 'active'; $active = false;} ?>">
                                        <img src="<?= $folder . $file ?>" class="d-block w-100" alt="">
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAutoplay" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselAutoplay" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="lc-block mb-3">
                        <div editable="rich">
                            <h2 class="fw-bold display-5">Welcome to Our Online Store</h2>
                        </div>
                    </div>

                    <div class="lc-block mb-3">
                        <div editable="rich">
                            <p class="lead">
                                Discover our featured products and best deals with a seamless online shopping experience.
                            </p>
                        </div>
                    </div>

                    <div class="lc-block d-grid gap-2 d-md-flex justify-content-md-start">
                        <a class="btn btn-primary px-4 me-md-2" href="shop.php" role="button">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="features" class="margin-side">
        <h2>Featured Deals!</h2>
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
                            <h5>$<?= $row['price'] ?></h5>
                        </a>
                        <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
    </section>

    <?php include("./view/footer.html"); ?>


    <script src="script/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>