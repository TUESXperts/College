<?php
include("./includes/connection.php");
include("./common-functions.php");


if(isset($_GET['command'])){
    $get_command = $_GET['command'];

    if($get_command == 'updateStudentsForCourse'){
        $id = $_GET['id'];
        echo "succccessss";
        header("Location: " . "/College/views/courseStudents.php?courseid=$id");
    }
} else if(isset($_POST['command'])){
    $post_command = $_POST['command'];

    if($post_command == 'addStudentToCourse') {
        $student_id = $_POST['studentid'];
        $course_id = $_POST['courseid'];

        $sql = "insert into students_courses set course_id='$course_id', student_id='$student_id'";
        $result = mysqli_query($connect, $sql);

        if($result){
            echo "success";
            exit;
        }
    } else if($post_command=='update') {
        $table = $_POST['table'];
        $inputs_keys = $_POST['inputs_keys'];
        $inputs_values = $_POST['inputs_values'];
        $result_string = generateResultUpdateQuery($inputs_keys,$inputs_values);

        //$sql="update $table set $result_string";
    } else if($post_command=='delete'){
        $table = $_POST['table'];
        $id = $_POST['id'];

        $sql = "delete from $table where id='$id'";
        $result = mysqli_query($connect, $sql);
        if($result) echo "success";
        else echo "error";
        exit;
    }
}

function generateResultUpdateQuery($inputs_keys, $inputs_values){
    $inputs_keys = transformColumnsToLowercase($inputs_keys);

    $sql_string = "";
    foreach($inputs_keys as $key){
   //     $sql_string .= $key
    }
}


?>