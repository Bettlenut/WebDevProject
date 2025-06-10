<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    if ($con->connect_error) {
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

    <div class="container" id="signup">
        <h1 class="form-title">Register</h1>
        <form method="post" action="register.php">
            <div id="name">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="fName" id="fName" placeholder="First Name" required>
                    <label for="fname">First Name</label>
                </div>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                    <label for="lName">Last Name</label>
                </div>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-address-book"></i>
                <input type="number" name="contactNumber" id="contactNumber" placeholder="Contact Number" required>
                <label for="contactNumber">Contact Number</label>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-map-location-dot"></i>
                <input type="text" name="address" id="address" placeholder="Address" required>
                <label for="address">Address</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                <label for="password">Password</label>
            </div>
            <div id="message">
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
            <input type="submit" class="btns" value="Sign Up" name="signUp">
        </form>
        <p class="or">
            OR
        </p>
        <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>
        <div class="links">
            <p>Already Have Account ?</p>
            <a href="Login.php"><button id="signInButton">Sign In</button></a>
        </div>
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

    <script>
        var myInput = document.getElementById("password");

        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }
        myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }
    </script>

    <script src="script/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</body>

</html>