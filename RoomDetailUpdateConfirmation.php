<?php include("include/header.php") ?>
<?php
require_once 'admin/connect.php';
if (isset($_POST['addRoom'])) {

    $roomNo = $_POST["roomNo"];
    $price = $_POST["price"];
    $roomType = $_POST["roomType"];
    echo @$roomType;
    $noOfPersons = $_POST["noOfPersons"];
    $amenities = $_POST["amenities"];
    $checkinDate = $_POST["checkinDate"];
    $checkOutDate = $_POST["checkOutDate"];
    echo 'check radio button';
    $yes = $_POST["openbookings"];
    echo @$yes;



    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "INSERT INTO `rooms`( `room_number`, `room_type`, `room_price`, `check_in_date`, `check_out_date`, `room_capacity`, `room_amenities`)
     VALUES ('$roomNo','$roomType','$price','$checkinDate','$checkOutDate','$noOfPersons','$amenities')";
    echo $query;
    // Execute the query
    $result = $conn->query($query) or die(mysqli_error());

    if ($result) {

        ?>

        <H2>Room added successfully></H2>
    <?php


    }

}


if (isset($_POST['deleteRoom'])) {

    $roomNo = $_POST["roomNo"];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "DELETE FROM `rooms` WHERE room_number =  '$roomNo';";
    echo $query;
    // Execute the query
    $result = $conn->query($query) or die(mysqli_error());

    if ($result) {

        ?>

        <H2>Room deleted successfully></H2>
    <?php


    }


}


if (isset($_POST['updateRoom'])) {

    $roomNo = $_POST["rooNo"];
    $roomType = $_POST["roomType"];
    $roomBooked = $_POST["roomBooked"];
    $roomFeatured = $_POST["roomFeatured"];
    $checkin = $_POST["checkin"];
    $checkout = $_POST["checkout"];
    $noOfPersons = $_POST["noOfPersons"];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "UPDATE `rooms` set `room_type` = '$roomType', `room_featured` = '$roomFeatured', `room_booked` = '$roomBooked', `check_in_date` = '$checkin', `check_out_date` = '$checkout', `room_capacity` = '$roomNo' WHERE `room_number` = '$roomNo'";
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