<?php
session_start();
include("./database.php");

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'], $_POST['quantity'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    $result = $con->prepare("SELECT id, productName, price, quantity, productImage FROM tbl_products WHERE id = ?");
    $result->bind_param("i", $product_id);
    $result->execute();
    $result->store_result();

    if ($result->num_rows > 0) {
        $result->bind_result($id, $name, $price, $stock, $image);
        $result->fetch();

        if ($quantity > $stock) {
            $quantity = $stock;
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
            if ($_SESSION['cart'][$product_id]['quantity'] > $stock) {
                $_SESSION['cart'][$product_id]['quantity'] = $stock;
            }
        } else {
            $_SESSION['cart'][$product_id] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'image' => $image
            ];
        }
    }
    $result->close();
}

if (isset($_GET['remove'])) {
    $remove_id = intval($_GET['remove']);
    unset($_SESSION['cart'][$remove_id]);
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
    <title>Your Cart</title>
    <link rel="stylesheet" href="stylesheet/shop.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">
    <?php include("./view/header.html"); ?>

    <div class="container my-5">
        <h2 class="mb-4">Your Cart</h2>

        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty. <a href="shop.php" class="text-info">Continue shopping</a>.</p>
        <?php else: ?>
            <table class="table table-dark table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($item['image']); ?>" width="80"></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            <td>
                                <a href="cart.php?remove=<?php echo $id; ?>" class="btn btn-danger btn-sm">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h4>Total: $<?php echo number_format($total, 2); ?></h4>
            <a href="checkout.php" class="btn btn-success mt-3">Checkout</a>
        <?php endif; ?>
    </div>

    <a href="shop.php">
        <center><button class="btn btn-secondary my-4">Continue Shopping</button></center>
    </a>

    <?php include("./view/footer.html"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>