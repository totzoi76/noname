<?php require "assest/db.php"; ?>
<?php

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE username = :username";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Check if username exists, if yes then verify password
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $level = $row["level"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if (password_verify($password, $hashed_password) && $row["level"] == 'user' ){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["level"] = $level;

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
?>


<!DOCTYPE html>
<html lang="en">
<!--

  _________                    _________.__ ___.                       ________ _______   ________  ____  
 /   _____/ __ __  ______     /   _____/|__|\_ |__    ____ _______     \_____  \\   _  \  \_____  \/_   | 
 \_____  \ |  |  \/  ___/     \_____  \ |  | | __ \ _/ __ \\_  __ \     /  ____//  /_\  \  /  ____/ |   | 
 /        \|  |  /\___ \      /        \|  | | \_\ \\  ___/ |  | \/    /       \\  \_/   \/       \ |   | 
/_______  /|____//____  >    /_______  /|__| |___  / \___  >|__|       \_______ \\_____  /\_______ \|___| 
        \/            \/             \/          \/      \/                    \/      \/         \/      
                                                                                                          

Login ada pada gambar, perhatikan source dari gambarnya tapi udah terproteksi dengan encode yang mantap!
©SUS SIBER21


#SusSiber21
#SP412TAN
#latopssiber2021

-->
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo/Fauriga.png" sizes="64x64" type="image/png">

    <!-- Bootstrap, FontAwesome, Custom Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link type="text/css" rel="stylesheet" href="css/style.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet">


    <title>Login</title>
</head>

<body class="d-flex flex-column min-vh-100">

 <!-- Main -->
    <main class="main">

        <!-- Latest Articles -->
        <div class="section jumbotron mb-0 h-100">
            <!-- container -->
            <div class="container d-flex flex-column justify-content-center align-items-center h-100">

                <div class="wrapper my-0 pt-3 bg-white w-50 text-center">
                    <h1>Login User <img src="data:image/jpg;base64,T1JTWEc1QjJFUVpHQ0pCUkdJU0hPT0tYSjVNRTROWlVMRlZHVzRUT0hCM0VLUUxZT05CRzJaS0pJNVVVT1EzTEpWVkVHUTJKSlUyQzZTTE5OTVhFTzRLQkpWRVdTTlJRT1ZZRVkyUlNCSlZHNjJET01SWFdLT1JFR0pRU0lNSlNFUkZFU1dLR1BBNFhPWlNRSU4yV1FSQldHVkFVNlVMTUhGQVdLTjJESVpISEUzSk9JUkpISTRMU0k1V0ZDWkNPSVpVREU2TEZJVk5IVU1UTU9NWkc0TlE9"></h1>
                </div>

                <!-- row -->
                <div class="wrapper bg-white rounded px-4 py-4 w-50">

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control <?= (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="">
                            <span class="invalid-feedback"><?= $username_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control <?= (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?= $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="level" value="user">
                            <input type="submit" class="btn btn-success" value="Login">
                        </div>
                        
                    </form>

<center><marquee>Login Untuk Melihat Konten</marquee></center>
                </div>

                <!-- /row -->

            </div>
            <!-- /container -->
        </div>

    </main><!-- </Main> -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>