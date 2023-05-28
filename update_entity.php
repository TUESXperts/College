<?php

session_start();

include("check_login.php");
if($_SESSION['role'] != "admin") {
    include("403_forbidden.php");
    return;
};

include("includes/connection.php");

// entity ID
$id = $_GET['updateid'];

if(isset($_POST['update'])){
    extract($_POST);

    $sql="UPDATE users SET firstname='$firstname', surname='$surname', username='$username', gender='$gender', password='$password'";
    if($role=="teacher") $sql.=",department='$department'";
    $sql.="WHERE id='$id'";

    $result=mysqli_query($connect, $sql);
    if($result) {
        header('location: admin_view.php?update_status=success');
    } else {
        header('location: admin_view.php?update_status=error');
    }
    return;
}

$sql="SELECT * FROM users WHERE id=$id";
$result=mysqli_query($connect, $sql);
$row=mysqli_fetch_assoc($result);

extract($row);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <?php include("includes/header_links.php"); ?>
</head>
<body>
<?php include("includes/header_navigation.php"); ?>
<div class="container">
    <div class="col-md-12">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 shadow-sm" style="margin-top:100px;">
                <form method="post">
                    <div class="container my-5">
                        <p style = "line-height:1.4">
                            <button class="btn btn-dark"><a href="<?=$_SESSION['previous_url']?>" class="text-light">Go back</a></button>
                        </p>

                        <div class="form-group">
                            <label for="firstname">First name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" autocomplete="off"
                                   placeholder="Enter new first name..." value=<?php echo $firstname;?>>
                        </div>

                        <div class="form-group">
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" id="surname" name="surname" autocomplete="off"
                                   placeholder="Enter new surname..." value=<?php echo $surname;?>>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" autocomplete="off"
                                   placeholder="Enter new username..." value=<?php echo $username;?>>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" autocomplete="off"
                                   placeholder="Enter new password..." value=<?php echo $password;?>>
                        </div>

                        <?php
                            if($role == "teacher") { ?>
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control" name="department" id="department">
                                        <?php print_options_for_all_departments($department); ?>
                                    </select>
                                </div>
                        <?php } ?>


                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option <?php echo ($gender == 'Male')? 'selected':''; ?>>Male</option>
                                <option <?php echo ($gender == 'Female')? 'selected':''; ?>>Female</option>
                                <option <?php echo ($gender == 'Non-binary')? 'selected':''; ?>>Non-binary</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>

<?php

    function get_all_departments(){
        global $connect;
        $result_arr=array();
        $sql = "select id, name from departments";
        $result=mysqli_query($connect, $sql);
        while($row=mysqli_fetch_assoc($result)){
            $temp_result['id'] = $row['id'];
            $temp_result['name'] = $row['name'];
            $result_arr[] = $temp_result;
        }
        return $result_arr;
    }

    function print_options_for_all_departments($selected_department_id){
        echo "<option <?php echo ($gender == 'Male')? 'selected':''; ?> value='0'>none</option>";
        foreach(get_all_departments() as $department){
            $selected_expression = ($department['id'] == $selected_department_id)? "selected" : "";
            echo "<option selected='$selected_expression' value='$department[id]'>$department[name]</option>";
        }
    }
?>