<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fName = $_POST["fName"];
        $lName = $_POST["lName"];
        $contactNumber = $_POST["contactNumber"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $password = $password . "system";
        $cipher = password_hash($password, PASSWORD_DEFAULT);

        // Database connection
        $con = mysqli_connect("localhost", "batch1", "batch1", "db_webdev", "3306");

        // Check connection
        if($con->connect_error){
            echo "Error: " . $con->connect_error;
        } else {
            echo "Connected successfully";
        }

        // Insert query
        $sql = "INSERT INTO `tbl_accounts`(`firstname`, `lastname`, `contactnumber`, `address`, `email`, `password`) VALUES ('$fName', '$lName', '$contactNumber', '$address', '$email', '$cipher')";
        
        if ($con->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
        header("Location: http://localhost/webdevproject/login.php");

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <section class="h-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img src="https://images.pexels.com/photos/15372903/pexels-photo-15372903/free-photo-of-computer-setup-with-big-monitor-screen.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                    alt="Sample photo" class="img-fluid"
                                    style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-light bg-dark">
                                    <h3 class="mb-5 text-uppercase">Registration Form</h3>

                                    <form action="Register.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="text" id="fName" name="fName" class="form-control form-control-lg" />
                                                    <label class="form-label" for="firstName">First Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="text" id="lName" name="lName" class="form-control form-control-lg" />
                                                    <label class="form-label" for="lastName">Last Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="number" id="contactNumber" name="contactNumber" class="form-control form-control-lg" />
                                            <label class="form-label" for="contactNumber">Contact Number</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" id="address" name="address" class="form-control form-control-lg" />
                                            <label class="form-label" for="address">Address</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" id="email" name="email" class="form-control form-control-lg" />
                                            <label class="form-label" for="email">Email</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                            <label class="form-label" for="password">Password</label>
                                        </div>

                                        <div class="d-flex justify-content-end pt-3">
                                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-warning btn-lg ms-2">Submit</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</body>

</html>