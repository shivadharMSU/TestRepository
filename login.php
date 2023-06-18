<?php include("include/header.php") ?>
<?php
require_once 'admin/connect.php';


global $loggedIn;
// Check if user is already logged in
if (isset($_SESSION['username'])) {
    header('Location: adminAddRoom.php');
    exit();
}

// Check if login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT `user_name`,`password` FROM `users` WHERE `user_name` = '$username' and `password`= '$password'"; // Replace "your_table_name" with your actual table name and "id" with the column to filter the record



    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the record as an associative array
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        $loggedIn = true;
        header('Location: adminAddRoom.php');
        exit();
    } else {
        $error = 'Invalid username or password';
    }


}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login - Hotel Management System</title>
    <style>
        .login-box {
            margin-top: 150px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 login-box">
                <div class="container container d-flex justify-content-center align-items-center container">
            <h3>Login</h3>
        </div>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="login.php">
                    <div class="row justify-content-center">
                        <div class="form-group col-md-4 col-md-offset-1 align-center">

                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="form-group col-md-4 col-md-offset-1 align-center">

                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>

                    <div class="container container d-flex justify-content-center align-items-center container">
                    <button type="submit" class="btn btn-primary savebtn">Login</button>
                </div>
                    <!-- <button type="submit" class="btn btn-primary btn-block">Login</button> -->
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>
<?php include("include/footer.php") ?>