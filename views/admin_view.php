<?php 

session_start();

include("../check_login.php");
if($_SESSION['role'] != "admin") {
    include("../403_forbidden.php");
    return;
};

include("../includes/connection.php");
include("../common-functions.php");


if(isset($_POST['submit']) && $_POST['operation'] == 'save'){
    extract($_POST);
    if($table == "college") {
        $sql = "update college set college_name='$college_name', college_address='college_address'";
    } else if($table == "users"){
        $sql = "update users set firstname='$firstname', surname='$surname' where rector_flag='1'";
    }

    $result=mysqli_query($connect, $sql);

    if($result) {
        header("Location: " . $_SERVER['REQUEST_URI']);
    } else {
        die(mysqli_error($connect));
    }

    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Employees administration</title>
    <?php include("../includes/header_links.php"); ?>
</head>
<body>

    <?php include("../includes/header_navigation.php"); ?>

	<div class="container" style="text-align:center">
        <div class="dropdown" style="float: left;">
            <button class="btn btn-secondary dropdown-toggle bg-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter data
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?=$_SERVER['PHP_SELF'] .'?data=college'?>">College data</a>
                <a class="dropdown-item" href="<?=$_SERVER['PHP_SELF'] .'?data=departments'?>">Departments</a>
                <a class="dropdown-item" href="<?=$_SERVER['PHP_SELF'] .'?data=faculties'?>">Faculties</a>
                <a class="dropdown-item" href="<?=$_SERVER['PHP_SELF'] .'?data=chancellor'?>">Chancellor data</a>
                <a class="dropdown-item" href="<?=$_SERVER['PHP_SELF'] .'?data=professors'?>">Professors</a>
                <a class="dropdown-item" href="<?=$_SERVER['PHP_SELF'] .'?data=students'?>">Students</a>
                <a class="dropdown-item" href="<?=$_SERVER['PHP_SELF'] .'?data=courses'?>">Courses</a>
            </div>
        </div>

                <?php

                if(!isset($_GET['data'])){
                    // show college data
                    $collegeTableName = "college";
                    echo "<h3>Default Table: " . $collegeTableName  . "</h3>";
                    $collegeLabelFields = array(
                            "college_name" => "College Name",
                            "college_address"=> "College address"
                    );

                    showSingleResultData($collegeTableName, $collegeLabelFields);
                } else {
                    echo "<h3>Table: " . $_GET['data']  . "</h3>";
                    if($_GET['data'] == "college"){
                        // show college data
                        $collegeTableName = "college";
                        $collegeLabelFields = array(
                            "college_name" => "College Name",
                            "college_address"=> "College address"
                        );

                        showSingleResultData($collegeTableName, $collegeLabelFields);
                    } else if($_GET['data'] == "departments"){
                        // show departments
                        $sql="SELECT d.id as id, d.name as department , c.college_name as college, u.firstname as departmentchair , f.name as faculty FROM departments as d left join college as c on d.college=c.id left join users as u on d.department_chair=u.id left join faculties as f on d.faculty=f.id";
                        $columns = array("Department", "College", "DepartmentChair", "Faculty");
                        $buttons=array(
                            "updateDepartment"=>array("color"=>"primary","label"=>"Update"),
                            "deleteDepartment"=>array("color"=>"danger","label"=>"Delete")
                        );
                        showMultipleResultsData($sql, $columns, $buttons);
                    } else if($_GET['data'] == "faculties"){
                       // show faculties
                       $sql="SELECT f.id as id, f.name as faculty , c.college_name as college FROM faculties as f left join college as c on f.college=c.id";
                       $columns = array("Faculty", "College");
                       showMultipleResultsData($sql, $columns);
                    } else if($_GET['data'] == "chancellor"){
                        // show chancellor
                        $chancellorTableName = "users";
                        $whereClause = "rector_flag='1'";
                        $chancellorLabelFields = array(
                            "firstname" => "Firstname",
                            "surname" => "Surname",
                            "role" => "Role"
                        );

                        showSingleResultData($chancellorTableName, $chancellorLabelFields, $whereClause);
                    } else if($_GET['data'] == "professors"){
                        // show professors
                        $sql="SELECT u.id, u.firstname, u.surname, u.username, d.name as department FROM users as u left join departments as d on u.department = d.id where u.role='teacher'";
                        $columns = array("Firstname", "Surname", "Username", "Department");
                        showMultipleResultsData($sql, $columns);
                    } else if($_GET['data'] == "students"){
                        // show students
                        $sql="SELECT u.id, u.firstname, u.surname, u.username, d.name as department FROM users as u left join departments as d on u.department = d.id where u.role='student'";
                        $columns = array("Firstname", "Surname", "Username", "Department");
                        showMultipleResultsData($sql, $columns);
                    } else if($_GET['data'] == "courses"){
                        // show courses
                        $sql="SELECT c.id, c.name as course, u.firstname as teacher, d.name as department FROM courses as c left join users as u on c.teacher=u.id left join departments as d on c.department = d.id";
                        $columns = array("Course", "Teacher", "Department");
                        showMultipleResultsData($sql, $columns);
                    }
                }
                ?>

    </div>
</body>
</html>

<script>
    $("button.btn-primary > a").click(function(e){
        e.preventDefault();

       // let inputs = $(this).closest('tr').find('input');

        var inputs_values = $(this).closest('tr').find('input').map(function() {
            return $(this).val();
        }).get();

        let inputs_keys = <?php echo json_encode($columns); ?>;

        let id = $(this).closest('tr').find('th').html();

        const urlParams = new URLSearchParams(window.location.search);
        const table = urlParams.get('data');

        let button = $(this).parent();

        $.ajax({
            url: "../update_handler.php",
            method: "post",
            data: {command:"update", table, inputs_keys, inputs_values, id},
            success: function(result){
                if(result == "success") {
                    console.log($(this));
                    button.replaceWith("<p style=\"color: green;\">Updated successfully</p>");
                }
                else alert("There was an error processing your request.");
            }
        });


    });
</script>

