<?php
include("./includes/header_links.php");
include("./includes/connection.php");

    if(isset($_POST['save'])){
        $type=$_POST['type'];
        if($type=="department"){
            $name = $_POST['name'];
            $departmentChair = $_POST['departmentChair'];
            $collegeSelected = $_POST['collegeSelected'];
            $facultySelected = $_POST['facultySelected'];

            $sql = "insert into departments set name='$name', college='$collegeSelected', department_chair='departmentChair', faculty='$facultySelected'";
            $result = mysqli_query($connect, $sql);
            if($result) header('location: /College/views/admin_view.php?added=success');
            else header('location: /College/views/admin_view.php?added=error');
            exit;
        }
    }

    if($_GET['show'] == "department"){

        $colleges = getColleges();
        print_r($colleges);
        $department_chair = getDepartmentChair();
        $faculties = getFaculties();
        print_r($faculties);
?>
<div class="container">
    <div class="col-md-12">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 shadow-sm" style="margin-top:100px;">
                <form method="post">
                    <div class="container my-5">
                        <p style = "line-height:1.4">
                            <button class="btn btn-dark"><a href="/College/views/admin_view.php" class="text-light">Go back</a></button>
                        </p>

                        <div class="form-group">
                            <label for="firstname">Department name</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Enter department name...">
                        </div>

                        <div class="form-group">
                            <label for="surname">College</label>
                            <select name="collegeSelected" id="colleges">
                                <option selected values="null">Choose a college</option>
                                <?php
                                    foreach($colleges as $college){
                                        echo '<option value="' . $college['id'] . '">' . $college['college_name'] . '</option>';
                                    }
                                ?>
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="firstname">Department Chair</label>
                            <input type="text" class="form-control" id="name" name="departmentChair" autocomplete="off" placeholder="Enter department chair name..." value="<?=$department_chair?>">
                        </div>

                        <div class="form-group">
                            <label for="surname">Faculty</label>
                            <select name="facultySelected" id="faculties">
                                <option selected values="null">Choose a faculty</option>
                                <?php
                                foreach($faculties as $id=>$faculty){
                                    echo '<option value="' . $faculty['id'] . '">' . $faculty['faculty_name'] . '</option>';
                                }
                                ?>
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="type" value="department">
                        <button type="submit" class="btn btn-primary" name="save">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php
}

    function getColleges(){
        global $connect;
        $colleges = [];
        $sql = "select id,college_name from college";
        $result=mysqli_query($connect, $sql);
        while($row=mysqli_fetch_assoc($result)){
            $colleges[] = array(
                "id"=>$row['id'],
                "college_name"=>$row['college_name']
            );
        }

        return $colleges;
    }


    function getDepartmentChair(){
        global $connect;
        $departmentChair="";
        $sql = "select firstname from users where rector_flag=1";
        $result=mysqli_query($connect, $sql);
        $departmentChair=mysqli_fetch_assoc($result)['firstname'];

        return $departmentChair;
    }

function getFaculties(){
    global $connect;
    $faculties = [];
    $sql = "select id,name as faculty_name from faculties";
    $result=mysqli_query($connect, $sql);
    while($row=mysqli_fetch_assoc($result)){
        $faculties[] = array(
            "id"=>$row['id'],
            "faculty_name"=>$row['faculty_name']
        );
    }

    return $faculties;
}
?>