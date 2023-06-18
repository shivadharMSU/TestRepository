<?php include("include/header.php") ?>
<?php require_once 'admin/connect.php' ?>
<div class="container">

    <?php

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $query = "SELECT id,category_name FROM `room_category_details`";
        $result = $conn->query($query);



        ?>
        <br>
        <div class="container container d-flex justify-content-center align-items-center container">
            <h2>Add Room</h2>
        </div>
        <br>

        <div class="container">
            <form method="POST" action="RoomDetailUpdateConfirmation.php">
                <div class="row justify-content-center">
                    <div class="form-group col-md-4 col-md-offset-1 align-center">
                        <label for="checkin">Room No:</label>
                        <input type="text" class="form-control" name="roomNo" placeholder="Enter Room Number" required
                            pattern="[0-9]" title="Room No should contain only numbers" required>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="form-group col-md-4 col-md-offset-1 align-center">
                        <label for="Room Type">Room Type:</label>
                        <select class="form-control" id="roomTypeId" name="roomType" required>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['category_name'] ?></option>

                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="form-group col-md-4 col-md-offset-1 align-center">
                        <label for="openbookings">Open for bookings:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="openbookings" id="yes" value="1" required>
                            <label class="form-check-label" for="yes">yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="openbookings" id="no" value="0" required>
                            <label class="form-check-label" for="no">No</label>
                        </div>

                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="form-group col-md-4 col-md-offset-1 align-center">
                        <label for="checkin">Max no of persons:</label>
                        <input type="number" class="form-control" name="noOfPersons" placeholder="Enter Max No of persons"
                            required required pattern="[0-9]" title="max room capacity">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="form-group col-md-4 col-md-offset-1 align-center">
                        <label for="checkin">Check-in:</label>
                        <input type="date" class="form-control" id="checkin" name="checkinDate" required
                            min="<?php echo date('Y-m-d'); ?>" onchange="updateCheckOutDate()">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-md-4 col-md-offset-1 align-center">
                        <label for="checkout">Check-out:</label>
                        <input type="date" class="form-control" id="checkout" name="checkOutDate" required>
                    </div>
                </div>

                <div class="container container d-flex justify-content-center align-items-center container">
                    <button type="submit" class="btn btn-primary savebtn" name="addRoom">Add room</button>
                </div>
            </form>
        </div>

        <script>
            function updateCheckOutDate() {
                var checkinDate = document.getElementById("checkin").value;
                var checkoutInput = document.getElementById("checkout");

                checkoutInput.value = ""; // Clear previous value
                checkoutInput.setAttribute("min", checkinDate); // Set minimum value for checkout

                // Enable the input field after setting the minimum value
                checkoutInput.removeAttribute("readonly");
            }
        </script>
        <?php
    } else {
        echo '<h1>please login</h1>';
    }
    ?>


</div>
