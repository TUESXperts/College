<?php

session_start();

include("../check_login.php");
if($_SESSION['role'] != "student" && $_SESSION['role'] != "admin") {
//    var_dump("AZ SUM: " . $_SESSION['role']);
    include("../403_forbidden.php");
    return;
};

include("../includes/connection.php");
include("../common-functions.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Teachers administration</title>
    <?php include("../includes/header_links.php"); ?>
</head>
<body>

<?php include("../includes/header_navigation.php"); ?>


<div class="container" style="text-align:center">
    <h3>Courses </h3>

    <?php
    // show courses
    $sql="SELECT sc.id, c.name as course, d.name as department, sc.marks FROM students_courses as sc left join courses as c on sc.course_id = c.id left join departments as d on c.department = d.id where sc.student_id='$_SESSION[user_id]'";
    $columns = array("Course", "Department", "Marks");
    $buttons = null; // no buttons
    showMultipleResultsData($sql, $columns, $buttons);
    ?>
</div>
</body>
</html>