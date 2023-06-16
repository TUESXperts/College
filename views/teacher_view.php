<?php

session_start();

include("../check_login.php");
if($_SESSION['role'] != "teacher" && $_SESSION['role'] != "admin") {
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
        $sql="SELECT c.id, c.name as course, d.name as department FROM courses as c left join users as u on c.teacher=u.id left join departments as d on c.department = d.id where u.id='$_SESSION[user_id]'";
        $columns = array("Course", "Department");
        // prepare custom buttons
        $buttons=array(
            "updateStudentsForCourse"=>array("color"=>"success","label"=>"Edit")
        );
        showMultipleResultsData($sql, $columns, $buttons);
        ?>
</div>
</body>
</html>