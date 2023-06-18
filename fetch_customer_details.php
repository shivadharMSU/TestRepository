<?php require_once 'admin/connect.php' ?>
<?php
// Establish a database connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the room_id parameter is provided
if (isset($_POST['berf_Id'])){

// if (isset($_POST['berf_Id'])) {
   
    $bookingRefNo = $_POST['berf_Id'];
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
        <div class="row">
            <div class="col">
                <p><strong>City: </strong>
                <?php echo $rowCustDetails['city']; ?>
                </p>

            </div>
            <div class="col">
                <p><strong>State: </strong>
                <?php echo $rowCustDetails['state']; ?>
                </p>
            </div>
            <div class="col">
                <p><strong>Email: </strong>
                <?php echo $rowCustDetails['email']; ?>
                </p>
            </div>
            <div class="col">
                <p><strong>Check-in: </strong>
                <?php echo $rowCustDetails['checkin']; ?>
                </p>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <p><strong>Check-out: </strong>
                <?php echo $rowCustDetails['checkout']; ?>
                </p>

            </div>
            <div class="col">
                <p><strong>No of adults: </strong>
                <?php echo $rowCustDetails['no_of_adults']; ?>
                </p>
            </div>
            <div class="col">
                <p><strong>No of children: </strong>
                <?php echo $rowCustDetails['no_of_children']; ?>
                </p>
            </div>
            <div class="col">
                <p><strong>No of persons: </strong>
                <?php echo $rowCustDetails['no_of_persons']; ?>
                </p>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <p><strong>No of rooms: </strong>
                <?php echo $rowCustDetails['no_of_rooms']; ?>
                </p>

            </div>
            <div class="col">
                <p><strong>No of days: </strong>
                <?php echo $rowCustDetails['no_of_days']; ?>
                </p>
            </div>
            <div class="col">
                <p><strong>Room type: </strong>
                <?php echo $rowCustDetails['room_type']; ?>
                </p>
            </div>
            <div class="col">
                
            </div>

        </div>
    <?php
} else {
    echo "Invalid request. ghbjnk";
}

$conn->close();
?>