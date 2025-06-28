<?php
session_start();
include("./database.php");

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="stylesheet/shop.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">
    <?php include("./view/header.html"); ?>

    <div class="container my-5">
        <h2 class="mb-4">Checkout</h2>

        <h3>Order Summary</h3>
        <ul class="list-group mb-3">
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                    <?php echo htmlspecialchars($item['name']); ?> (x<?php echo $item['quantity']; ?>)
                    <span>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                </li>
            <?php endforeach; ?>
            <li class="list-group-item bg-dark text-light d-flex justify-content-between">
                <strong>Total:</strong>
                <strong>$<?php echo number_format($total, 2); ?></strong>
            </li>
        </ul>
        <center><button type="submit" class="btn btn-primary">Pay Now</button></center>
    </div>

    <a href="cart.php">
        <center><button class="btn btn-secondary my-4">Back to Cart</button></center>
    </a>

    <?php include("./view/footer.html"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>