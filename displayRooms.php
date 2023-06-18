<?php include("include/header.php") ?>
<?php require_once 'admin/connect.php' ?>


<div class="container">

    <div class="container container d-flex justify-content-center align-items-center container">
        <h2>Rooms</h2>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Room ID</th>
                <th>Room Number</th>
                <th>Room Type</th>
                <th>Featured</th>
                <th>Booked</th>
                <th>Check-in Date</th>
                <th>Check-out Date</th>
                <th>Capacity</th>
                <th>Booking Reference ID</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Execute the query
            $query = "SELECT `room_id`, `room_number`, `room_type`, `room_featured`, `room_booked`, `check_in_date`, `check_out_date`, `room_capacity`, `booking_ref_id` FROM `rooms`";

            $result = $conn->query($query);

            // Fetch and display the records
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    ?>
                    <tr>
                        <td>
                            <?php echo $row['room_id']; ?>
                        </td>
                        <td>
                            <?php echo $row['room_number']; ?>
                        </td>
                        <td>
                            <?php
                            $roomTypeId = $row['room_type'];
                            $queryRoomTpe = "SELECT id,category_name,price,aminities FROM `room_category_details` WHERE `id` = '$roomTypeId'";
                            $resultRoomType = mysqli_query($conn, $queryRoomTpe);
                            if ($resultRoomType && mysqli_num_rows($resultRoomType) > 0) {
                                $rowRoomType = mysqli_fetch_assoc($resultRoomType);
                                echo $rowRoomType['category_name'];
                            } else {
                                echo 'N/A';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $roomFeatured = $row['room_featured'];
                            $displayValueRoomFeatured = ($roomFeatured == 1) ? "Yes" : "No";
                            ?>
                            <?php echo $displayValueRoomFeatured; ?>
                        </td>
                        <td>
                            <?php
                            $roomBooked = $row['room_booked'];
                            $displayValueRoomBooked = ($roomBooked == 1) ? "Yes" : "No";
                            ?>
                            <?php echo $displayValueRoomBooked; ?>
                        </td>

                        <td>
                            <?php echo $row['check_in_date']; ?>
                        </td>
                        <td>
                            <?php echo $row['check_out_date']; ?>
                        </td>
                        <td>
                            <?php echo $row['room_capacity']; ?>
                        </td>
                        <td>
                            <a href="#" class="customer-ref" data-berfid="<?php echo $row['booking_ref_id']; ?>">
                                <?php echo $row['booking_ref_id']; ?>
                            </a>

                        </td>;



                        <!-- dialog box -->




                        <!-- close dialog box -->
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='9'>No records found</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="customerBookingDetailsModel" tabindex="-1" role="dialog"
    aria-labelledby="customerBookingDetailsModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerBookingDetailsModalLabel">Booking Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="customerBookingContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.customer-ref').on('click', function (e) {
            e.preventDefault();
            var berfid = $(this).data('berfid');
            console.log(berfid);
            fetchBookingDetails(berfid);
        });




        function fetchBookingDetails(berfId) {
            console.log(berfId)
            $.ajax({
                url: 'fetch_customer_details.php',
                method: 'POST',
                data: { berf_Id: berfId },
                success: function (response) {
                    $('#customerBookingContent').html(response);
                    $('#customerBookingDetailsModel').modal('show');
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }

    });
</script>

<?php include("include/footer.php") ?>