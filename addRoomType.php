<?php include("include/header.php") ?>
<?php require_once 'admin/connect.php' ?>
<div class="container">

    <?php

    // if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (true) {
        $query = "SELECT id,category_name FROM `room_category_details`";

        ?>
          <br>
        <div class="container container d-flex justify-content-center align-items-center container">
            <h2>Add Room category</h2>
        </div>
        
        <br>
        
        <div class="container">
        <form method="POST" action="roomTypeUpdateConfirmation.php">
            <div class="row justify-content-center">
                <div class="form-group col-md-4 col-md-offset-1 align-center">
                    <label for="checkin">Room Category:</label>
                    <input type="text" class="form-control" required pattern="[A-Za-z]+" name="roomTypeName" title="Room category name should contain only alphabets" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-4 col-md-offset-1 align-center">
                    <label for="checkin">Price:</label>
                    <input type="text" class="form-control" name="price" required pattern="[0-9]" title="Price should contain only digits" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-4 col-md-offset-1 align-center">
                    <label for="checkin">Amenities:</label>
                    <input type="text" class="form-control" name="amenities" pattern="[A-Za-z]+" title="Room category name should contain only alphabets" required>
                </div>
            </div>

            <div class="container container d-flex justify-content-center align-items-center container">
                <button type="submit" class="btn btn-primary savebtn" name="addRoomCategory">Save</button>
            </div>

        </form>
        </div>
        <?php
    } else {
       ?>
        <div class="container container d-flex justify-content-center align-items-center container">
            <h2>Please login</h2>
        </div>
        <?php
    }
    ?>

</div>
<?php include("include/footer.php") ?>