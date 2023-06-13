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


    $list_of_students = [];
    // show students  who are not part of this course yet
    $sql1="SELECT c.department from courses as c where c.id='$_GET[courseid]'";

    $result1=mysqli_query($connect, $sql1);
    $row1=mysqli_fetch_assoc($result1);
    $current_department = $row1['department'];

    $sql="SELECT id,firstname,surname from users where role='student' and department='$current_department'";
    $result=mysqli_query($connect, $sql);

    while($row=mysqli_fetch_assoc($result)){
        $sql2="select * from students_courses where course_id='$_GET[courseid]' and student_id='$row[id]'";
        $result2=mysqli_query($connect, $sql2);
        $row2=mysqli_fetch_assoc($result2);
        if(!$row2) {
            // if this student is not already added to the current course
            $list_of_students[]=array($row['id'], $row['firstname'], $row['surname']);
        }
    }

    printStudentsList($list_of_students);
    ?>
</div>

</body>
</html>
<script>
    $("button[command-attr='addStudentToCourse'] > a").click(function(e){
        e.preventDefault();

        let studentid = $(this).parent().attr("id"); // retrieving from the button element
        const urlParams = new URLSearchParams(window.location.search);
        const courseid = urlParams.get('courseid');

        let button = $(this).parent();

        $.ajax({
            url: "update_handler.php",
            method: "post",
            data: {command:"addStudentToCourse", studentid, courseid},
            success: function(result){
                if(result == "success") {
                    console.log($(this));
                    button.replaceWith("<p style=\"color: green;\">Added successfully</p>");
                }
                else alert("There was an error processing your request.");
            }
        });
    });
</script>


<?php
    function printStudentsList($list_of_students){

        $buttons=array(
                "addStudentToCourse"=>array("color"=>"primary","label"=>"Add to course")
        );

        if(!empty($list_of_students)) {
            $_SESSION['previous_url'] = $_SERVER['REQUEST_URI']; ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Surname</th>
                </tr>
                </thead>
                <tbody>
                <?php
            foreach($list_of_students as $student) {
                $i=0;
                foreach ($student as $attr) {
                   if($i==0) echo "<tr><th scope=\"row\">" . $attr . "</th>";
                   else echo "<td>" . $attr . "</td>";
                    $i++;
                } ?>

                <td>
                    <p style = "line-height:1.4">
                        <?php
                        foreach($buttons as $button_command=>$button_attributes){
                            // $student[0] = id-to
                            echo '<button command-attr="'. $button_command .'" style="margin-right:10px;" id="'. $student[0] .'" class="btn btn-'. $button_attributes['color'] .'"><a href="/College/update_handler.php?command='. $button_command .'&id=' . $student[0] . '" class="text-light">' . $button_attributes['label'] . '</a></button>';
                        }
                        ?>
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
?>