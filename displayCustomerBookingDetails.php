<?php include("include/header.php") ?>
<?php require_once 'admin/connect.php' ?>
<div class="container">
    <br>
    <div class="container container d-flex justify-content-center align-items-center container">
        <h2>Customer Booking Details</h2>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Street Name</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Price</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>No of adults</th>
                    <th>No of children</th>
                    <th>no of rooms</th>
                    <th>No of persons</th>
                    <th>No of days</th>
                    <th>Booking ref id</th>
                    <th>Room Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Establish a database connection
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                // Fetch customer booking details query
                $query = "SELECT `id`, `name`, `mobile`, `email`, `address`, `streetname`, `city`, `state`, `roomType`, `price`, `checkin`, `checkout`, `no_of_adults`, `no_of_children`, `no_of_rooms`, `no_of_persons`, `no_of_days`, `bookingRefId` FROM `customer_bookings`";
                $result = $conn->query($query);

                $queryRoomNo = "SELECT `id`, `name`, `mobile`, `email`, `address`, `streetname`, `city`, `state`, `roomType`, `price`, `checkin`, `checkout`, `no_of_adults`, `no_of_children`, `no_of_rooms`, `no_of_persons`, `no_of_days`, `bookingRefId` FROM `customer_bookings`";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["mobile"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["streetname"] . "</td>";
                        echo "<td>" . $row["city"] . "</td>";
                        echo "<td>" . $row["state"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td>" . $row["checkin"] . "</td>";
                        echo "<td>" . $row["checkout"] . "</td>";
                        echo "<td>" . $row["no_of_adults"] . "</td>";
                        echo "<td>" . $row["no_of_children"] . "</td>";
                        echo "<td>" . $row["no_of_rooms"] . "</td>";
                        echo "<td>" . $row["no_of_persons"] . "</td>";
                        echo "<td>" . $row["no_of_days"] . "</td>";
                        echo "<td>" . $row["bookingRefId"] . "</td>";
                        echo "<td>" . $row["roomType"] . "</td>";
                        // echo "<td><a href='#' class='room-link' data-roomid='" . $row["id"] . "'>" . $row["no_of_rooms"] . "</a></td>";
                        // echo "<td><button class='btn btn-primary view-room' data-roomid='" . $row["id"] . "'>View Room Details</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No bookings found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Room Details Modal -->
<div class="modal fade" id="roomDetailsModal" tabindex="-1" role="dialog" aria-labelledby="roomDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roomDetailsModalLabel">Room Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="roomDetailsContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('.room-link').on('click', function (e) {
            e.preventDefault();
            var roomId = $(this).data('roomid');
            console.log(roomId);
            fetchRoomDetails(roomId);
        });

        $('.view-room').on('click', function () {
            var roomId = $(this).data('roomid');
            console.log(roomId);
            fetchRoomDetails(roomId);
        });

        function fetchRoomDetails(roomId) {
            $.ajax({
                url: 'fetch_customer_details.php',
                method: 'POST',
                data: { room_id: roomId },
                success: function (response) {
                    $('#roomDetailsContent').html(response);
                    $('#roomDetailsModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });
</script>


<?php include("include/footer.php") ?>