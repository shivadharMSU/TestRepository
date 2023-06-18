<?php include("include/header.php") ?>
<?php
require_once 'admin/connect.php';
if (isset($_POST['personalInfo'])) {

    $name = $_POST["fullname"];
    echo @$name;
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $streetname = $_POST["streetname"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $roomType = $_POST["roomType"];
    $price = $_POST["price"];
    $checkin = $_POST["checkin"];
    $checkout = $_POST["checkout"];
    $noOfAdults = $_POST["noOfAdults"];
    $noOfChildren = $_POST["noOfChildren"];
    $roomCapacity = $_POST["roomCapacity"];
    echo $checkout;
    $noOfRooms = $_POST["noOfRooms"];
    echo $noOfRooms;

    echo $roomCapacity;

    $noOfDays = $_POST["noOfDays"];


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $roomquery = "select room_number,room_type from  rooms where room_type='$roomType' and room_featured = '1' and room_booked = '0' and check_in_date <= '$checkin' and check_out_date >= '$checkout' and room_capacity >= '$roomCapacity' LIMIT $noOfRooms;";
    echo $roomquery;
    // Execute the query
    $roomqueryResult = $conn->query($roomquery) or die(mysqli_error());
    echo 'checking if condition';
    if ($roomqueryResult->num_rows >= $noOfRooms) {
           echo $noOfRooms;
        $query = "INSERT INTO `customer_bookings`( `name`, `mobile`, `email`, `address`, `streetname`, `city`, `state`, `roomType`, `price`, `no_of_adults`,`no_of_children`,`no_of_rooms`, `no_of_persons`,`no_of_days`, `checkin`, `checkout`) VALUES ('$name','$mobile','$email','$address','$streetname','$city','$state','$roomType','$price','$noOfAdults','$noOfChildren','$noOfRooms','$roomCapacity','$noOfDays','$checkin','$checkout');";
        echo $query;
        // Execute the query
        $result = $conn->query($query) or die(mysqli_error());

        if ($result) {
            $lastInsertId = mysqli_insert_id($conn);
            $refid = 'HTS' . $lastInsertId;
            echo @$refid;
            $queryUpdate = "UPDATE `customer_bookings` SET `bookingRefId`='$refid' WHERE id = '$lastInsertId'";
            echo @$queryUpdate;
            $result = $conn->query($queryUpdate) or die(mysqli_error());

            if ($result) {


                while ($roomRow = $roomqueryResult->fetch_assoc()) {
                    $roomNo = $roomRow['room_number'];
                    $queryRoomUpdate = "UPDATE `rooms` SET `room_booked`= 1,`booking_ref_id`= '$refid'  where room_number = $roomNo";
                    echo @$queryRoomUpdate;
                    $result = $conn->query($queryRoomUpdate) or die(mysqli_error());
                    if ($result) {
                        ?>

                        <H2>thanks for booking with us
                            <?php echo $refid ?>
                        </H2>
                        <?php
                    }

                }



            }


        }

    } else {
        ?>

        <H2>Oops! Rooms no longer available, Please try booking again
            <?php echo $refid ?>
        </H2>
        <?php
    }

}
?>
<?php include("include/footer.php") ?>