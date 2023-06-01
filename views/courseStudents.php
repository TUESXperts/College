<?php
session_start();

include("../check_login.php");
if($_SESSION['role'] != "teacher" && $_SESSION['role'] != "admin") {
//    var_dump("AZ SUM: " . $_SESSION['role']);
    include("../403_forbidden.php");
    return;
};

include("../includes/connection.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Teachers administration</title>
    <?php include("../includes/header_links.php"); ?>
</head>
<body>

<?php include("../includes/header_navigation.php"); ?>


<div class="container" style="text-align:center;display: flex;flex-direction: column;">
    <button class="btn btn-dark" style="width: max-content;"><a href="<?=$_SESSION['previous_url']?>" class="text-light">Go back to courses</a></button>
    <?php
        $course_name = "";
        $sql = "select name from courses where id=$_GET[courseid] limit 1";
        $result=mysqli_query($connect, $sql);
        if($result_row=mysqli_fetch_assoc($result)) $course_name = $result_row['name'];
    ?>
    <h3>Students for course: "<?=$course_name?>": </h3>

    <?php
    // show courses
    $sql="SELECT u.id, u.firstname, u.surname, sc.marks from users as u left join students_courses as sc on u.id=sc.student_id where u.role='student' and sc.course_id=$_GET[courseid]";
    $columns = array("Firstname", "Surname", "Marks");
    showMultipleResultsData($sql, $columns);
    ?>
</div>
</body>
</html>

<?php
function showMultipleResultsData($sql, $columns){
    global $connect;
    $result=mysqli_query($connect, $sql);

    if($result) {
        $_SESSION['previous_url'] = $_SERVER['REQUEST_URI']; ?>
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
                    if($column == "marks") echo '<td><input type="text" value="' . $$column . '"/></td>';
                    else echo "<td>" . $$column . "</td>";
                } ?>

                <td>
                    <p style = "line-height:1.4">
                        <button class="btn btn-success"><a href="/College/courseStudents.php?courseid=<?=$id?>" class="text-light">Save marks</a></button>
                        <button class="btn btn-danger"><a href="/College/update_user.php?deleteid=<?=$id?>" class="text-light">Remove student from course</a></button>

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
