<?php include("include/header.php") ?>
<?php
require_once 'admin/connect.php';
if (isset($_POST['addRoomCategory'])) {

    $roomTypeName = $_POST["roomTypeName"];
    $price = $_POST["price"];
    $amenities = $_POST["amenities"];




    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "INSERT INTO `room_category_details`(`category_name`, `price`, `aminities`) VALUES ('$roomTypeName','$price','$amenities');";
    echo $query;
    // Execute the query
    $result = $conn->query($query) or die(mysqli_error());

    if ($result) {

        ?>

        <H2>new Room Category added successfully></H2>
        <?php


    }

}


if (isset($_POST['deleteRoomCategory'])) {

    $roomTypeId = $_POST["roomTypeId"];


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "DELETE FROM `room_category_details` WHERE id =  '$roomTypeId';";
    echo $query;
    // Execute the query
    $result = $conn->query($query) or die(mysqli_error());

    if ($result) {

        ?>

        <H2>Room category deleted successfully></H2>
        <?php


    }


}


if (isset($_POST['updateRoomCategory'])) {

   
    $price = $_POST["price"];
    $amenities = $_POST["amenities"];
    $roomTypeId = $_POST["roomTypeId"];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "UPDATE `room_category_details` SET `price`='$price',`aminities`='$amenities' WHERE `id`='$roomTypeId'";
    echo $query;
    // Execute the query
    $result = $conn->query($query) or die(mysqli_error());

    if ($result) {

        ?>

        <H2>Room details updated successfully></H2>
        <?php


    }


}
?>
<?php include("include/footer.php") ?>