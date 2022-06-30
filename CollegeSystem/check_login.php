<?php
    // Check if the current user is logged
    if(!$_SESSION['user_id']) {
        header("Location: index.php");
    }
?>