<?php include("include/header.php") ?>
<?php require_once 'admin/connect.php' ?>
<?php $checkin = $checkout = $noOfAdults = $noOfChildren = ""; ?>
<div class="container container d-flex justify-content-center align-items-center container">
    <h2>Check-in at 11:00 am and check-out at 10:00 pm</h2>
</div>
<div class="container d-flex justify-content-center align-items-center container">

    <br>
    <form method="POST" class="form-inline" action="">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="checkin">Check-in Date:</label>
                    <input type="date" class="form-control" name="checkin" id="checkin" placeholder="Checkin Date"
                        required min="<?php echo date('Y-m-d'); ?>" onchange="updateCheckOutDate()">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="checkout">Check-out Date:</label>
                    <input type="date" class="form-control" name="checkout" id="checkout" placeholder="Checkout Date"
                        required>

                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="checkin">No of Adults:</label>
                    <input type="number" class="form-control" name="noOfAdults" placeholder="Enter number" required
                        min="1" value="<?php echo $noOfAdults; ?>">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="checkin">No of children:</label>
                    <input type="number" class="form-control" name="noOfChildren" placeholder="Enter number" required
                        min="1" value="<?php echo $noOfChildren; ?>">
                </div>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary btnround mb-2" name="searchroom">Search</button>
            </div>
        </div>
    </form>
    <br>
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchroom'])) {

    $checkin = $_POST["checkin"];
    $checkout = $_POST["checkout"];
    $noOfAdults = $_POST["noOfAdults"];
    $noOfChildren = $_POST["noOfChildren"];

    $noOfPersons = $noOfAdults + $noOfChildren;



    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $query = "select room_type,count(*) AS noOfRooms from rooms where room_featured = '1' and room_booked = '0' and check_in_date <= '$checkin' and check_out_date >= '$checkout' and room_capacity >= '$noOfPersons' group by room_type;";


    $result = $conn->query($query);

    if ($result->num_rows > 0) {

        ?>
        <div class="container container d-flex justify-content-center align-items-center container">
            <h2>Rooms available</h2>
        </div>
        <?php
        while ($row = $result->fetch_assoc()) {
            $roomType = $row['room_type'];
            echo $roomType;
            $queryRoomType = "SELECT id,category_name,price,aminities FROM `room_category_details` WHERE id = '$roomType' ";

            $resultRoomType = mysqli_query($conn, $queryRoomType);
            $rowRoomType = mysqli_fetch_assoc($resultRoomType);
            ?>
            <br><br><br>

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="room-details">
                            <div>
                                <h2>Room Type:
                                    <?php echo $rowRoomType['category_name'] ?>
                                </h2>
                                <p>Price: $
                                    <?php echo $rowRoomType['price'] ?> per night
                                </p>
                                <p>Amenities:
                                    <?php echo $rowRoomType['aminities'] ?>
                                </p>
                                <p>No of available rooms:
                                    <?php echo $row['noOfRooms'] ?>
                                </p>
                                <form method="POST" action="bookroom.php" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="checkin" class="room-display">No of rooms:</label>
                                        <input type="number" class="form-control room-display-input" name="noOfRooms"
                                            placeholder="Enter number" required max="<?php echo $row['noOfRooms'] ?>"
                                            title="Should not exceed no od available rooms" />
                                    </div>

                                    <input type="hidden" class="form-control" name="checkin" value="<?php echo $checkin ?>"
                                        required />

                                    <input type="hidden" class="form-control" name="checkout" value="<?php echo $checkout ?>"
                                        required />

                                    <input type="hidden" class="form-control" name="noOfAdults" value="<?php echo $noOfAdults ?>"
                                        required />

                                    <input type="hidden" class="form-control" name="noOfChildren"
                                        value="<?php echo $noOfChildren ?>" required />


                                    <input type="hidden" class="form-control" name="roomCapacity" value="<?php echo $noOfPersons ?>"
                                        required />


                                    <input type="hidden" class="form-control" name="roomType" value="<?php echo $roomType ?>"
                                        required />


                                    <input type="hidden" class="form-control" name="roomPrice"
                                        value="<?php echo $rowRoomType['price'] ?>" required />


                                    <input type="hidden" class="form-control" name="roomAmenities"
                                        value="<?php echo $rowRoomType['aminities'] ?>" required />

                                    <button class="btn btn-primary savebtn" name="bookroom"> <span>Book </span></button>

                                </form>
                            </div>

                        </div>
                    </div>
                    <br>
                    <!-- <div class="col-md-6">
                        <img src="images/1.jpg" alt="Hotel Room Image">
                    </div> -->

                    <!-- Image List -->

                    <div class="col-md-6">
                        <div class="img-room">
                            <img src="images/<?php echo $rowRoomType['id'] ?>-1.jpg" class="room-image" alt="Room image">
                        </div>
                        <!-- <img src="images/1.jpg"> -->
                        <!-- Show More Button -->
                        <!-- <div class="text-center mt-2">
                            <a href="#" data-toggle="modal" data-target="#myModal">Show More</a>
                        </div> -->

                        <div class="text-center mt-2">
                            <a href="#" class="show-more-btn" data-toggle="modal" data-target="#myModal"
                                data-roomid="<?php echo $rowRoomType['id']; ?>">Show More</a>
                        </div>

                        <!-- open model -->

                        <!-- close model -->

                    </div>



                </div>




            </div>



            <?php
        }

        ?>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">More images
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div>
                            <div class="row">
                                <div id="modalImages"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('.show-more-btn').click(function () {
                    var roomId = $(this).data('roomid');

                    // Clear previous images
                    $('#modalImages').empty();

                    // Add new images dynamically
                    var images = [
                        roomId + '-2.jpg',
                        roomId + '-3.jpg',
                        roomId + '-4.jpg',
                        roomId + '-5.jpg'
                    ];

                    for (var i = 0; i < images.length; i++) {
                        var imgSrc = 'images/' + images[i];
                        var imgElement = $('<img>').attr('src', imgSrc).addClass('zoom').attr('alt', 'Room image').css({
                            width: '200px',
                            height: '80px'
                        });
                        var imgElement = $('<img>').attr('src', imgSrc).addClass('zoom').attr('alt', 'Room image').css({
                            width: '200px',
                            height: '80px'
                        });

                        $('#modalImages').append(imgElement);
                    }
                });
            });
        </script>
        <?php
    } else {
        echo "<p>No rooms available</p>";
    }


}

?>


<!-- Include Bootstrap JS -->
<?php include("include/footer.php") ?>