<?php 

session_start();

include("../check_login.php");
if($_SESSION['role'] != "admin") {
    include("403_forbidden.php");
    return;
};

include("../includes/connection.php");

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
        <h3>Table: <?=$_GET['data']?></h3>
                <?php

                if(!isset($_GET['data'])){
                    // show college data
                    $collegeTableName = "college";
                    $collegeLabelFields = array(
                            "college_name" => "College Name",
                            "college_address"=> "College address"
                    );

                    showSingleResultData($collegeTableName, $collegeLabelFields);
                } else {
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
                        showMultipleResultsData($sql, $columns);
                    } else if($_GET['data'] == "faculties"){
                       // show faculties
                       $sql="SELECT f.id as id, f.name as faculty , c.college_name as college FROM faculties as f left join college as c on f.college=c.id";
                       $columns = array("Faculty", "College");
                       showMultipleResultsData($sql, $columns);
                    } else if($_GET['data'] == "chancellor"){
                        // show chancellor
                        $chancellorTableName = "users";
                        $chancellorLabelFields = array(
                            "firstname" => "Firstname",
                            "surname" => "Surname",
                            "role" => "Role"
                        );

                        showSingleResultData($chancellorTableName, $chancellorLabelFields);
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


<?php
    function showSingleResultData($table, $columnLabelFields){
        global $connect;
        $columns = array_keys($columnLabelFields); // fetching all columns
        $sql="SELECT " . implode(",",$columns) . " FROM " . $table . " limit 1";
        $result=mysqli_query($connect, $sql);

        if($result) {
            $row=mysqli_fetch_assoc($result); ?>

            <form>
                <?php
                    foreach ($columnLabelFields as $db_column_name => $column_label ) { ?>
                        <div class="form-group">
                            <label for="field"><?=$column_label?></label>
                            <input type="text" id="field" class="form-control" placeholder="Enter <?=$column_label?>" value="<?=$row[$db_column_name]?>">
                        </div>
                        <?php
                    } ?>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <?php
        }
    }

    function showMultipleResultsData($sql, $columns){
        global $connect;
        $result=mysqli_query($connect, $sql);

        if($result) { ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <?php
                        foreach($columns as $column){
                            echo "<th scope=\"col\">$column</th>";
                        }
                        $columnsLowercase = transformColumnsToLowercase($columns);
                    ?>
                </tr>
                </thead>
                <tbody>
                <?php
                while($row=mysqli_fetch_assoc($result)) {
                    extract($row);
                    echo "<tr><th scope=\"row\">" . $id . "</th>";
                    foreach($columnsLowercase as $column){
                        echo "<td>" . $$column . "</td>";
                    } ?>

                     <td>
                        <p style = "line-height:1.4">
                           <button class="btn btn-success"><a href="updateEmployee.php?updateid='.$id.'" class="text-light">Edit</a></button>
                           <button class="btn btn-danger"><a href="deleteEmployee.php?deleteid='.$id.'" class="text-light">Delete</a></button>
                        </p>
                     </td>
                    </tr>
          <?php
                } ?>
                </tbody>
            </table>
            <?php
        }
    }

    function transformColumnsToLowercase($columns){
        $resultLowercaseColumns = array_map('strtolower', $columns);
        return $resultLowercaseColumns;
    }
?>