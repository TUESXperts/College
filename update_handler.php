<?php

if(isset($_GET['command'])){
    $get_command = $_GET['command'];
    $id = $_GET['id'];
    if($get_command == 'updateStudentsForCourse'){
        echo "succccessss";
        header("Location: " . "/College/views/courseStudents.php?courseid=$id");
    }
}
?>