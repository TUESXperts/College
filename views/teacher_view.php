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


<div class="container" style="text-align:center">
    <h3>Courses: </h3>

        <?php
            // show courses
        $sql="SELECT c.id, c.name as course, d.name as department FROM courses as c left join users as u on c.teacher=u.id where u.id='" . $_SESSION['user_id'] . "' left join departments as d on c.department = d.id";
        $columns = array("Course", "Department");
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
                echo "<td>" . $$column . "</td>";
            } ?>

            <td>
                <p style = "line-height:1.4">
                    <button class="btn btn-success"><a href="/College/update_user.php?updateid=<?=$id?>" class="text-light">Edit</a></button>
                    <button class="btn btn-danger"><a href="/College/update_user.php?deleteid=<?=$id?>" class="text-light">Delete</a></button>
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