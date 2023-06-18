
<?php
session_start();
global $loggedIn;
if (isset($_SESSION['username'])) {
    $loggedIn = true;
}else{
    $loggedIn = false;
}
?>