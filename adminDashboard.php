<?php
session_start();

$con = mysqli_connect("localhost", "batch1", "batch1", "db_webdev", "3306");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$accountsQuery = "SELECT * FROM `tbl_accounts`";
$accountsResult = $con->query($accountsQuery);

$productsQuery = "SELECT * FROM `tbl_products`";
$productsResult = $con->query($productsQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="bg-dark text-white">
    <?php include("view/header.html"); ?>

    <div class="container py-4">
        <h2>Accounts List</h2>
        <a href="createAccount.php" class="btn btn-primary mb-3">Add Account</a>
        <table class="table table-dark table-striped table-bordered">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Number</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Admin Privileges</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $accountsResult->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['firstname'] ?></td>
                        <td><?= $row['lastname'] ?></td>
                        <td><?= $row['contactnumber'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['admin_privileges'] ?></td>
                        <td style="white-space: nowrap; width: 1%;">
                            <div class="d-flex gap-1">
                                <a href='editAccount.php?id=<?= $row['id'] ?>' class='btn btn-primary btn-sm'>Edit</a>
                                <a href='deleteAccount.php?id=<?= $row['id'] ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2 class="mt-5">Products List</h2>
        <a href="createProduct.php" class="btn btn-success mb-3">Add Product</a>
        <table class="table table-dark table-striped table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th>Image Source</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = $productsResult->fetch_assoc()): ?>
                    <tr>
                        <td><?= $product['productName'] ?></td>
                        <td><?= $product['price'] ?></td>
                        <td><?= $product['quantity'] ?></td>
                        <td><?= $product['productDescription'] ?></td>
                        <td><?= $product['productImage'] ?></td>
                        <td style="white-space: nowrap; width: 1%;">
                            <div class="d-flex gap-1">
                                <a href='editProduct.php?id=<?= $product['id'] ?>' class='btn btn-primary btn-sm'>Edit</a>
                                <a href='deleteProduct.php?id=<?= $product['id'] ?>' class='btn btn-danger btn-sm' onclick="return confirm('Delete this product?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>