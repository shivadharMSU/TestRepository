<?php require_once 'admin/connect.php' ?>
<?php
// Establish a database connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the room_id parameter is provided
if (isset($_POST['room_id'])) {
    $roomId = $_POST['room_id'];
    // Fetch room details query
    $query = "SELECT `room_id`, `room_number`, `room_type`, `room_featured`, `room_booked`, `check_in_date`, `check_out_date`, `room_capacity`, `booking_ref_id` FROM `rooms` WHERE `room_number` = $roomId";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $roomId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display the room details
        echo "<h5>Room Number: " . $row["room_number"] . "</h5>";
        echo "<p>Room Type: " . $row["room_type"] . "</p>";
        echo "<p>Room Capacity: " . $row["room_capacity"] . "</p>";
        // Add more room details as needed
    } else {
        echo "Room details not found.";
    }

    $stmt->close();
} else if (isset($_POST['berfId'])) {
    $bookingRefNo = $row['berfId'];
    echo $bookingRefNo;
    $queryCustDetails = "SELECT `name`,`email`,`address`,`mobile`,`city`,`state`,`email`,`checkin`,`checkout`,`no_of_adults`,`no_of_children`,`no_of_persons`,`no_of_rooms`,`no_of_days`, (select `category_name` from `room_category_details` where `id` =`roomType` ) AS `room_type`,`price` FROM customer_bookings WHERE `bookingRefId` = '$bookingRefNo';";
    // Execute the query
    $resultCustDetails = mysqli_query($conn, $queryCustDetails);

    if ($resultCustDetails && mysqli_num_rows($resultCustDetails) > 0) {

        // Fetch the record as an associative array
        $rowCustDetails = mysqli_fetch_assoc($resultCustDetails);
    }

    ?>
        <div class="row">
            <div class="col">
                <p><strong>Name: </strong>
                <?php echo $rowCustDetails['name']; ?>
                </p>

            </div>
            <div class="col">
                <p><strong>Email: </strong>
                <?php echo $rowCustDetails['email']; ?>
                </p>
            </div>
            <div class="col">
                <p><strong>Mobile: </strong>
                <?php echo $rowCustDetails['mobile']; ?>
                </p>
            </div>
            <div class="col">
                <p><strong>Address: </strong>
                <?php echo $rowCustDetails['address']; ?>
                </p>
            </div>

        </div>
    <?php
} else {
    echo "Invalid request.";
}

$conn->close();
?>