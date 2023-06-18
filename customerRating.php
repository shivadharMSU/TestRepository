<?php include("include/header.php") ?>

<body>
    <div class="container">
        <h1>Customer Rating Form</h1>
        <form method="POST" action="submitRating.php">
            <div class="row">
                <div class="form-group">
                    <label for="checkin">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="checkin">Rating:</label>
                    <div class="rating">

                        <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                        <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                        <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                        <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                        <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label for="feedback">Feedback:</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="feedback" rows="3" value="Please enter your Feedback here"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script src="js/addons/rating.js"></script>
    <?php include("include/footer.php") ?>