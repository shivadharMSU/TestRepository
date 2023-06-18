<?php include("include/header.php") ?>
<?php
require_once 'admin/connect.php';
if (isset($_POST['bookroom'])) {
    $checkin = $_POST["checkin"];
    $checkout = $_POST["checkout"];
    $noOfAdults = $_POST["noOfAdults"];
    $noOfChildren = $_POST["noOfChildren"];
    $roomCapacity = $_POST["roomCapacity"];
    $roomType = $_POST["roomType"];
    $roomPrice = $_POST["roomPrice"];
    $roomAmenities = $_POST["roomAmenities"];
    $noOfRooms = $_POST["noOfRooms"];
    $roomPrice = $roomPrice * $noOfRooms;

    $checkInTimestamp = strtotime($checkin);
    $checkOutTimestamp = strtotime($checkout);

    // Calculate the difference in seconds
    $difference = $checkOutTimestamp - $checkInTimestamp;

    // Convert seconds to days
    $noOfDays = floor($difference / (60 * 60 * 24));
    $roomPrice = $roomPrice * $noOfDays;


    ?>
    <div class="container container d-flex justify-content-center align-items-center container">
        <h2>Personal Information</h2>
    </div>
    <br>
    <div class="container">

        <form method="POST" action="BookingFinal.php">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="checkin">Name:</label>
                        <input type="text" class="form-control" name="fullname" required required pattern="[A-Za-z]+" title="Name should contain only alphabets" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="checkin">Mobile:</label>
                        <input type="tel" class="form-control" name="mobile" required name="mobile" required pattern="[0-9]{10}" title="Mobile No should be 10 digits" placeholder="Enter mobile Number">
                    </div>
                    <div class="form-group">
                        <label for="checkin">Email:</label>
                        <input type="email" class="form-control" name="email" required placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="checkin">Address:</label>
                        <input type="text" class="form-control" name="address" required placeholder="Enter address"  title="Enter Address">
                    </div>
                    <div class="form-group">
                        <label for="checkin">Street Name:</label>
                        <input type="text" class="form-control" name="streetname" required placeholder="Enter Street name"  title="Enter Street Name">
                    </div>
                    <div class="form-group">
                        <label for="checkin">City:</label>
                        <input type="text" class="form-control" name="city" required placeholder="Enter City" required pattern="[A-Za-z]+" title="City should contain only alphabets">
                    </div>
                    <div class="form-group">
                        <label for="checkin">State:</label>
                        <input type="text" class="form-control" name="state" required placeholder="Enter state" required pattern="[A-Za-z]+" title="Name should contain only alphabets">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="noOfAdults" value="<?php echo $noOfAdults ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="noOfChildren" value="<?php echo $noOfChildren ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="checkin">Room Type:</label>
                        <input type="text" class="form-control" name="roomType" value="<?php echo $roomType ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="checkin">Price:</label>
                        <input type="text" class="form-control" name="price" value="<?php echo $roomPrice ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="checkin">Amenities:</label>
                        <input type="text" class="form-control" name="roomAmenities" value="<?php echo $roomAmenities ?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="checkin">Check-in Date:</label>
                        <input type="date" class="form-control" name="checkin" value="<?php echo $checkin ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="checkout">Check-out Date:</label>
                        <input type="date" class="form-control" name="checkout" value="<?php echo $checkout ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="checkout">No Of Rooms:</label>
                        <input type="text" class="form-control" name="noOfRooms" value="<?php echo $noOfRooms ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="checkout">Max capacity:</label>
                        <input type="text" class="form-control" name="roomCapacity" value="<?php echo $roomCapacity ?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="checkout">No Of Days:</label>
                        <input type="text" class="form-control" name="noOfDays" value="<?php echo $noOfDays ?>" readonly>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary savebtn" name="personalInfo">Save</button>
                </div>

            </div>
        </form>
    </div>

    <?php
}

?>
<?php include("include/footer.php") ?>