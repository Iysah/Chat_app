<?php
    session_start();
    if (isset($_SESSION['unique_id'])) {
        // If user is loggrd in then come to this page otherwise go to login page
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if (isset($logout_id)) {
            // If logout id is set
            $status = "Offline now";

            // Once the user logout then the status will update to OFFLINE and once logged in will update to ACTIVE NOW
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$logout_id}");

            if($sql) {
                session_unset();
                session_destroy();
                header("location: ../login.php");
            } else {
                header("location: ../users.php");
            }
        }
    } else {
        header("location: ../login.php");
    }
?>