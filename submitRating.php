<?php include("include/header.php") ?>
<?php
require_once 'admin/connect.php';
if (isset($_POST['rating'])) {


    $email = $_POST["email"];
    $rating = $_POST["rating"];
    
    $feedback = $_POST["feedback"];



    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "INSERT INTO `customer_ratings`( `email`, `rating`, `feedback`) VALUES ('$email','$rating','$rating')";
    $result = $conn->query($query) or die(mysqli_error());

    if ($result) {

        ?>

        <H2>Thanks for submitting request</H2>
        <?php


    } else {
        ?>

        <H2>Oops! Please try again after some
            <?php echo $refid ?>
        </H2>
        <?php
    }

}
?>
<?php include("include/footer.php") ?>