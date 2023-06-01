<?php
session_start();

include("../check_login.php");
if($_SESSION['role'] != "teacher" && $_SESSION['role'] != "admin") {
//    var_dump("AZ SUM: " . $_SESSION['role']);
    include("../403_forbidden.php");
    return;
};

include("../includes/connection.php");


// AJAX call
if(isset($_POST['studentid'])){
    $studentid = $_POST['studentid'];
    $courseid = $_POST['courseid'];

    if($_POST['command'] == "savemarks"){
        $studentMarks = $_POST['studentMarks'];

        $sql_query_1 = "select marks from students_courses where course_id=$courseid and student_id=$studentid limit 1";
        $result_1=mysqli_query($connect, $sql_query_1);
        if($result_row_1=mysqli_fetch_assoc($result_1)) {
            if($result_row_1['marks'] == null){
                // insert query
                $sql_query_insert = "insert into students_courses set marks='$studentMarks' where course_id=$courseid and student_id=$studentid";
                $result_2=mysqli_query($connect, $sql_query_insert);
                echo "success1";
            } else {
                // update query
                $sql_query_insert = "update students_courses set marks='$studentMarks' where course_id=$courseid and student_id=$studentid";
                $result_2=mysqli_query($connect, $sql_query_insert);
                echo "success2";
            }
            echo "success";
        } else echo "error";
    } else if($_POST['command'] == "removestudentfromcourse"){
        $sql = "delete from students_courses where course_id=$courseid and student_id=$studentid limit 1";
        $result=mysqli_query($connect, $sql);
        if($result) echo "success";
        else "error";
    }

    exit;
}
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
                echo "<tr data-studentid='$id'><th scope=\"row\">" . $id . "</th>";
                foreach($columnsLowercase as $column){
                    if($column == "marks") echo '<td><input type="text" value="' . $$column . '" data-studentmarksinput="' . $id . '"/></td>';
                    else echo "<td>" . $$column . "</td>";
                } ?>

                <td>
                    <p style = "line-height:1.4">
                        <button class="btn btn-success" data-savestudentid="<?=$id?>">Save marks</button>
                        <button class="btn btn-danger" data-removestudentid="<?=$id?>">Remove student from course</button>

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


<script>
    $(document).ready(function(){
        $("button[data-savestudentid]").click(function(){
            let studentid = $(this).attr("data-savestudentid");
            let studentMarks = $("input[data-studentmarksinput=" + studentid + "]").val();

            const urlParams = new URLSearchParams(window.location.search);
            const courseid = urlParams.get('courseid');
            console.log("the course id is: " + courseid);

            $.ajax({
                url: "courseStudents.php",
                method: "post",
                data: {studentid, courseid, studentMarks, command: "savemarks"},
                success: function(result){
                    if(result == "success") alert("Marks were successfully updated.");
                    else alert("There was an error processing your request.");
                }
            });
        });

        $("button[data-removestudentid]").click(function(){
            let studentid = $(this).attr("data-removestudentid");
            const urlParams = new URLSearchParams(window.location.search);
            const courseid = urlParams.get('courseid');
            
            $.ajax({
                url: "courseStudents.php",
                method: "post",
                data: {studentid, courseid, command: "removestudentfromcourse"},
                success: function(result){
                    if(result == "success") $("tr[data-studentid=" + studentid + "]").remove();
                    else alert("There was an error processing your request.");
                }
            });
        });
    });
</script>
