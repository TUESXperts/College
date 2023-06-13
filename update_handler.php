<?php
include("./includes/connection.php");

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
    }
}
?>