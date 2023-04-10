<?php

session_start();

include("check_login.php");
if($_SESSION['role'] != "head_of_department" || $_SESSION['role'] != "admin") {
    include("403_forbidden.php");
    return;
};

include("includes/connection.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Employees administration</title>
    <?php include("includes/header_links.php"); ?>
</head>
<body>

<?php include("includes/header_navigation.php"); ?>

<div class="container" style="text-align:center">
    <button class="btn btn-info my-5" style="float:left;">
        <a href="addService.php" class="text-light" >
            Load Students
        </a>
    </button>
    <button class="btn btn-info my-5 " style="float:left; margin:5px;">
        <a href="showServices.php" class="text-light" >
            Show Services
        </a>
    </button>
    <button class="btn btn-info my-5" style="float:right;">
        <a href="addEmployee.php" class="text-light" >
            Register Employee
        </a>
    </button>


    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First name</th>
            <th scope="col">Surname</th>
            <th scope="col">Username</th>
            <th scope="col">Gender</th>
            <th scope="col">Contract type</th>
            <th scope="col">Hiring date</th>
        </tr>
        </thead>
        <tbody>

        <?php

        $sql="SELECT id,firstname, surname, username, gender, contract_type, hiring_date FROM users WHERE role='employee'";
        $result=mysqli_query($connect, $sql);
        if($result) {
            $i = 1;
            while($row=mysqli_fetch_assoc($result)) {
                $id=$row['id'];
                $firstname = $row['firstname'];
                $surname=$row['surname'];
                $username=$row['username'];
                $gender = $row['gender'];
                $contract_type = $row['contract_type'];
                $hiring_date = $row['hiring_date'];

                echo '
                                <tr>
                                    <th scope="row">' . $i . '</th>
                                    <td>'.$firstname.'</td>
                                    <td>'.$surname.'</td>
                                    <td>'.$username.'</td>
                                    <td>'.$gender.'</td>
                                    <td>'.$contract_type.'</td>
                                    <td>'.$hiring_date.'</td>
                                    <td>
                                    <p style = "line-height:1.4">
                                        <button class="btn btn-success"><a href="updateEmployee.php?updateid='.$id.'" class="text-light">Edit</a></button>
                                        <button class="btn btn-danger"><a href="deleteEmployee.php?deleteid='.$id.'" class="text-light">Delete</a></button>
                                    </p>
                                    </td>
                                </tr>
                            ';
                $i++;
            }
        }

        ?>
        </tbody>
    </table>

</div>
</body>
</html>