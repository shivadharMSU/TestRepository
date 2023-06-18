<?php include("include/header.php") ?>
<?php require_once 'admin/connect.php' ?>
<div class="container container d-flex justify-content-center align-items-center container">
    <h2>Edit Room</h2>
</div>
<div class="container d-flex justify-content-center align-items-center container">

    <br>
    <form method="POST">

        <div class="form-group">
            <label for="Room Type">Room Type:</label>
            <select class="form-control" id="roomTypeId" name="roomTypeId">
                <?php
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $query = "SELECT id,category_name FROM `room_category_details`"; // Replace "your_table_name" with your actual table name and "id" with the column to filter the record
                
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['category_name'] ?></option>

                        <?php
                    }
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary savebtn" name="fetchRoomCategory">Fetch Category Details</button>
    </form>
</div>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fetchRoomCategory'])) {
    $roomTypeId = $_POST["roomTypeId"];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT id,category_name,price,aminities FROM `room_category_details` WHERE `id` = '$roomTypeId'"; // Replace "your_table_name" with your actual table name and "id" with the column to filter the record



    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the record as an associative array
        $row = mysqli_fetch_assoc($result);

        // Close the database connection

        ?>
<br><br>
        <div class="container">
            
            <form method="POST" action="roomTypeUpdateConfirmation.php">

                <div class="row justify-content-center">
                    <div class="form-group">
                        <label for="checkin">Room type id:</label>
                        <input type="hidden" class="form-control" name="roomTypeId" value="<?php echo $row['id'] ?>" required>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group">
                        <label for="checkin">Price:</label>
                        <input type="text" class="form-control" name="price" value="<?php echo $row['price'] ?>" required>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group">
                        <label for="checkin">Aminities:</label>
                        <input type="text" class="form-control" name="amenities" value="<?php echo $row['aminities'] ?>"
                            required>
                    </div>
                </div>

                <div class="container container d-flex justify-content-center align-items-center container">
                    <button type="submit" class="btn btn-primary savebtn" name="updateRoomCategory">Save</button>
                </div>

            </form>
        </div>
        <?php
    } else {
        // No record found
        echo "No record found.";
    }
}
?>
<?php include("include/footer.php") ?>