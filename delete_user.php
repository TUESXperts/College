<?php

include("includes/connection.php");

//We use GET method, so we can get access to the parameteres from the database
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="DELETE FROM users WHERE id=$id";
    $result=mysqli_query($connect, $sql);

    if($result){
        header('location:admin.php');
    } else {
        die(mysqli_error($connect));
    }
}

?>