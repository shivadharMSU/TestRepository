<?php include("include/header.php") ?>
<?php require_once 'admin/connect.php' ?>
<br>
<div class="container">
<form method="POST" action="">
    <div class="row justify-content-center">
                    <div class="form-group col-md-4 col-md-offset-1 align-center">
            <label for="checkin">Booking Ref No:</label>
            <input type="text" class="form-control" name="BookingRef" required>
        </div> 
    </div>

    <div class="container container d-flex justify-content-center align-items-center container">
    <button type="submit" class="btn btn-primary savebtn" name="getBookings">Submit</button>
</div>
         
        
    </form>

</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['getBookings'])) {
    $bookingRef = $_POST["BookingRef"];


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Construct the query to check for available rooms
    //$query = "SELECT `name`,`email`,`mobile`,`address`,`city`,`state`,`roomType`,`no_of_adults`,`no_of_children`,`no_of_rooms` from customer_bookings where bookingRefId = '$bookingRef'";
    $query = "SELECT `name`,`email`,`address`,`mobile`,`city`,`state`,`email`,`checkin`,`checkout`,`no_of_adults`,`no_of_children`,`no_of_persons`,`no_of_rooms`,`no_of_days`, (select `category_name` from `room_category_details` where `id` =`roomType` ) AS `room_type`,`price` FROM customer_bookings WHERE `bookingRefId` = '$bookingRef';";
    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {

        // Fetch the record as an associative array
        $row = mysqli_fetch_assoc($result);



        ?>
        <!-- #region -->
        <div class="container">

            <div class="container container d-flex justify-content-center align-items-center container">
                <h2>Booking Details</h2>
            </div>
            <div class="row">
                <div class="col-md-12 center">
                    <table class="table center table-striped">
                        <!-- <thead>
                    <tr>
                       <th>Booking Ref Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>city</th>
                        <th>state</th>
                        <th>checkin</th>
                        <th>checkout</th>
                        <th>no_of_adults</th>
                        <th>no_of_children</th>
                        <th>no_of_persons</th>
                        <th>no_of_rooms</th>
                        <th>no_of_days</th>
                        <th>room_type</th>
                        <th>price</th>
                        
                    </tr>
                </thead> -->
                        <tbody>

                            <tr>
                                <th scope="row">Booking Ref Id</th>

                                <td>
                                    <?php echo $bookingRef ?>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Name</th>
                                <td>
                                    <?php echo $row['name']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>
                                    <?php echo $row['email']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>
                                    <?php echo $row['mobile']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>
                                    <?php echo $row['address']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>
                                    <?php echo $row['city']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td>
                                    <?php echo $row['state']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Check-in-Date</th>
                                <td>
                                    <?php echo $row['checkin']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Check-out-date</th>
                                <td>
                                    <?php echo $row['checkout']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>No of adults</th>
                                <td>
                                    <?php echo $row['no_of_adults']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>no of children</th>
                                <td>
                                    <?php echo $row['no_of_children']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>No Of Persons</th>
                                <td>
                                    <?php echo $row['no_of_persons']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>No Of Rooms</th>
                                <td>
                                    <?php echo $row['no_of_rooms']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>No Of Days</th>
                                <td>
                                    <?php echo $row['no_of_days']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Room Category</th>
                                <td>
                                    <?php echo $row['room_type']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>
                                    <?php echo $row['price']; ?>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
    } else {

    }
}
?>
<?php include("include/footer.php") ?>