<?php
session_start();

$id = $_GET['id'];

if (isset($_POST['Save'])) {
    $id = $_POST['id'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $contactNumber = $_POST['contactNumber'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $adminPrivileges = $_POST['adminPrivileges'];

    $con = mysqli_connect("localhost", "batch1", "batch1", "db_webdev", "3306");

    $sql = "UPDATE tbl_accounts SET 
                firstname = '$fName',
                lastname = '$lName',
                contactnumber = '$contactNumber',
                address = '$address',
                email = '$email',
                admin_privileges = '$adminPrivileges'
            WHERE id = $id";

    if (mysqli_query($con, $sql)) {
        header("Location: http://localhost/webdevproject/adminDashboard.php");
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="stylesheet/sign.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="bg-dark text-white">
    <?php include("./view/header.html"); ?>

    <div class="container" id="signup">
        <h1 class="form-title">Edit</h1>
        <?php
        $con = mysqli_connect("localhost", "batch1", "batch1", "db_webdev", "3306");

        $sql = "SELECT * FROM `tbl_accounts` WHERE id = $id LIMIT 1";

        $result = $con->query($sql);

        $row = $result->fetch_assoc();

        ?>

        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div id="name">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="fName" id="fName" value=<?php echo $row['firstname'] ?> required>
                    <label for="fname">First Name</label>
                </div>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="lName" id="lName" value=<?php echo $row['lastname'] ?> required>
                    <label for="lName">Last Name</label>
                </div>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-address-book"></i>
                <input type="number" name="contactNumber" id="contactNumber" value=<?php echo $row['contactnumber'] ?> required>
                <label for="contactNumber">Contact Number</label>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-map-location-dot"></i>
                <input type="text" name="address" id="address" value=<?php echo $row['address'] ?> required>
                <label for="address">Address</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" value=<?php echo $row['email'] ?> required>
                <label for="email">Email</label>
            </div>
            <i class="fas fa-user-shield"></i>
            <select name="adminPrivileges" id="adminPrivileges" required>
                <option value="" disabled selected>Is Admin?</option>
                <option value="yes" <?php if ($row['admin_privileges'] == 'yes') echo 'selected'; ?>>Yes</option>
                <option value="no" <?php if ($row['admin_privileges'] == 'no') echo 'selected'; ?>>No</option>

            </select>
            <label for="adminPrivileges">Admin Privileges</label>
            <input type="submit" class="btns" value="Update" name="Save">

        </form>
    </div>

    <?php include("./view/footer.html"); ?>

    <script src="script/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</body>

</html>