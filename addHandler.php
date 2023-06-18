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
        } else if($type=="student"){
            $firstname = $_POST['firstname'];
            $surname = $_POST['surname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $departmentSelected = $_POST['departmentSelected'];
            $role = "student";

            $sql = "insert into users set firstname='$firstname', surname='$surname', username='$username', password='$password', role='$role', department='$departmentSelected' ";
            $result = mysqli_query($connect, $sql);
            if($result) header('location: /College/views/admin_view.php?added=success');
            else header('location: /College/views/admin_view.php?added=error');
            exit;
        } else if($type=="professor"){
            $firstname = $_POST['firstname'];
            $surname = $_POST['surname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $departmentSelected = $_POST['departmentSelected'];
            $role = "teacher";

            $sql = "insert into users set firstname='$firstname', surname='$surname', username='$username', password='$password', role='$role', department='$departmentSelected' ";
            $result = mysqli_query($connect, $sql);
            if($result) header('location: /College/views/admin_view.php?added=success');
            else header('location: /College/views/admin_view.php?added=error');
            exit;
        }
        else if($type=="course"){
            $courseSelected = $_POST['courseSelected'];
            $teacherSelected = $_POST['teacherSelected'];
            $departmentSelected = $_POST['departmentSelected'];

            $sql = "insert into courses set name='$courseSelected', teacher='$teacherSelected', department='$departmentSelected'";
            $result = mysqli_query($connect, $sql);
            if($result) header('location: /College/views/admin_view.php?added=success');
            else header('location: /College/views/admin_view.php?added=error');
            exit;
        } else if($type=="faculty"){
            $name = $_POST['name'];
            $collegeSelected = $_POST['collegeSelected'];

            $sql = "insert into faculties set name='$name', college='$collegeSelected'";
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
                                foreach($faculties as $faculty){
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
} else if($_GET['show'] == "student"){

    $departments = getDepartments();
    print_r($departments);
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
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" id="name" name="firstname" autocomplete="off" placeholder="Enter firstname...">
                        </div>

                        <div class="form-group">
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" id="name" name="surname" autocomplete="off" placeholder="Enter surname...">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="name" name="username" autocomplete="off" placeholder="Enter username...">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="name" name="password" autocomplete="off" placeholder="Enter password...">
                        </div>

                        <div class="form-group">
                            <label for="department">Department</label>
                            <select name="departmentSelected" id="departments">
                                <option selected values="null">Choose a department</option>
                                <?php
                                foreach($departments as $id=>$department){
                                    echo '<option value="' . $department['id'] . '">' . $department['department_name'] . '</option>';
                                }
                                ?>
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="type" value="student">
                        <button type="submit" class="btn btn-primary" name="save">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php
} else if($_GET['show'] == "course"){

    $courses = getCourses();
    print_r($courses);
    $teachers = getTeachers();
    print_r($teachers);
    $departments = getDepartments();
    print_r($departments);
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
                            <label for="course">Course</label>
                            <select name="courseSelected" id="courses">
                                <option selected values="null">Choose a course</option>
                                <?php
                                foreach($courses as $id=>$course){
                                    //echo '<option value="' . $course['id'] . '">' . $course['course_name'] . '</option>';
                                    echo '<option value="' . $course['course_name'] . '">' . $course['course_name'] . '</option>';
                                }
                                ?>
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="teacher">Teacher</label>
                            <select name="teacherSelected" id="teachers">
                                <option selected values="null">Choose a teacher</option>
                                <?php
                                foreach($teachers as $id=>$teacher){
                                    echo '<option value="' . $teacher['id'] . '">' . $teacher['teacher_name'] . '</option>';
                                }
                                ?>
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="department">Department</label>
                            <select name="departmentSelected" id="departments">
                                <option selected values="null">Choose a department</option>
                                <?php
                                foreach($departments as $id=>$department){
                                    echo '<option value="' . $department['id'] . '">' . $department['department_name'] . '</option>';
                                }
                                ?>
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="type" value="course">
                        <button type="submit" class="btn btn-primary" name="save">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php
} else if($_GET['show'] == "faculty"){

        $colleges = getColleges();
        print_r($colleges);
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
                                <label for="name">Faculty name</label>
                                <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Enter faculty...">
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

                            <input type="hidden" name="type" value="faculty">
                            <button type="submit" class="btn btn-primary" name="save">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
} else if($_GET['show'] == "professor"){

        $departments = getDepartments();
        print_r($departments);
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
                                    <label for="firstname">Firstname</label>
                                    <input type="text" class="form-control" id="name" name="firstname" autocomplete="off" placeholder="Enter firstname...">
                                </div>

                                <div class="form-group">
                                    <label for="surname">Surname</label>
                                    <input type="text" class="form-control" id="name" name="surname" autocomplete="off" placeholder="Enter surname...">
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="name" name="username" autocomplete="off" placeholder="Enter username...">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" id="name" name="password" autocomplete="off" placeholder="Enter password...">
                                </div>

                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select name="departmentSelected" id="departments">
                                        <option selected values="null">Choose a department</option>
                                        <?php
                                        foreach($departments as $id=>$department){
                                            echo '<option value="' . $department['id'] . '">' . $department['department_name'] . '</option>';
                                        }
                                        ?>
                                        ?>
                                    </select>
                                </div>
                                <input type="hidden" name="type" value="professor">
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

function getDepartments(){
        global $connect;
        $departments = [];
        $sql = "select id, name as department_name from departments";
        $result=mysqli_query($connect, $sql);
        while($row=mysqli_fetch_assoc($result)){
            $departments[] = array(
                "id"=>$row['id'],
                "department_name"=>$row['department_name']
            );
        }

        return $departments;
    }

    function getTeachers(){
        global $connect;
        $teachers = [];
        $sql = "select id, surname as teacher_name from users where role='teacher'";
        $result=mysqli_query($connect, $sql);
        while($row=mysqli_fetch_assoc($result)){
            $teachers[] = array(
                "id"=>$row['id'],
                "teacher_name"=>$row['teacher_name']
            );
        }

        return $teachers;
    }

    function getCourses(){
        global $connect;
        $courses = [];
        $sql = "select id, name as course_name from courses";
        $result=mysqli_query($connect, $sql);
        while($row=mysqli_fetch_assoc($result)){
            $courses[] = array(
                "id"=>$row['id'],
                "course_name"=>$row['course_name']
            );
        }

        return $courses;
    }


?>