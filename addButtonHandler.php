<?php
session_start();

include("./check_login.php");
if($_SESSION['role'] != "teacher" && $_SESSION['role'] != "admin") {
    include("../403_forbidden.php");
    return;
};

include("./includes/connection.php");
include("./common-functions.php");

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php
        if($_GET["command"] == "addStudentToCourse"){ ?>
            <title>Add Student to course</title>
    <?php
        }
    ?>
    ?>
    <?php include("includes/header_links.php"); ?>
</head>
<body>
<?php
    include("includes/header_navigation.php");
    // get the current course name from DB
    $course_name = "";
    $sql = "select name from courses where id=$_GET[courseid] limit 1";
    $result=mysqli_query($connect, $sql);
    if($result_row=mysqli_fetch_assoc($result)) $course_name = $result_row['name'];

    // get the current department name from DB
    $department_name="";
    $sql = "select d.name from departments as d left join courses as c on c.department=d.id where c.id=$_GET[courseid] limit 1";
    $result=mysqli_query($connect, $sql);
    if($result_row=mysqli_fetch_assoc($result)) $department_name = $result_row['name'];
?>
<div class="container">
    <div class="container" style="max-width: 50%;">
        <button class="btn btn-dark"><a href="<?=$_SESSION['previous_url']?>" class="text-light">Go back to the students</a></button>
    </div>
</div>F

<div class="container" style="text-align:center;">
    <h3>List of all students of the current department: "<?=$department_name?>"</h3>
    <h4>Add new student for course: "<?=$course_name?>": </h4>
    <?php
    // show courses
    $sql="SELECT u.id, u.firstname, u.surname FROM students_courses as sc left join users as u on u.id=sc.student_id left join courses as c on sc.course_id=c.id where sc.course_id!=$_GET[courseid] and u.department=c.department";
    $columns = array("Firstname", "Surname");
    showMultipleResultsData($sql, $columns, $buttons=array("addStudentToCourse"=>"Add to course"));
    ?>
</div>

</body>
</html>
