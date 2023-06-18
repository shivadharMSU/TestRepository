<?php include("include/header.php") ?>
<?php require_once 'admin/connect.php' ?>
<div class="container">
        <br>
<div class="container container d-flex justify-content-center align-items-center container">
            <h2>Delete Room</h2>
        </div>
    <br>
    <form method="POST" action="RoomDetailUpdateConfirmation.php">
    <div class="row justify-content-center">
                    <div class="form-group col-md-4 col-md-offset-1 align-center">
            <label for="checkin">Room No:</label>
            <input type="text" class="form-control" name="roomNo" required>
        </div> 
    </div>

    <div class="container container d-flex justify-content-center align-items-center container">
    <button type="submit" class="btn btn-primary savebtn" name="deleteRoom">Delete</button>
</div>
         
        
    </form>
  
  
       
</div>
<?php include("include/footer.php") ?>
