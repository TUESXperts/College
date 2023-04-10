<?php 
    session_start();
    $success = session_unset();
    if($success) header("Location: index.php");
    else header("Location: " . $_SERVER['HTTP_REFERER']);
 ?>