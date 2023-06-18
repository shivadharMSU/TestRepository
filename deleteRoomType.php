<?php include("include/header.php") ?>
<?php require_once 'admin/connect.php' ?>
<div class="container">

    <br>
    <div class="container container d-flex justify-content-center align-items-center container">
        <h2>Delete Room Category</h2>
    </div>
    <br>
    <form method="POST" action="roomTypeUpdateConfirmation.php">
        <div class="row justify-content-center">
            <div class="form-group col-md-4 col-md-offset-1 align-center">
                <label for="Room Type">Room Type:</label>
                <select class="form-control" id="roomTypeId" name="roomTypeId">
                    <?php
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $query = "SELECT id,category_name FROM `room_category_details`";

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
        </div>

        <div class="container container d-flex justify-content-center align-items-center container">
    <button type="submit" class="btn btn-primary savebtn" name="deleteRoomCategory">Delete</button>
</div>
    </form>



</div>
<?php include("include/footer.php") ?>