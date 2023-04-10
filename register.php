<?php 

include("includes/connection.php");

$output = "";

if (isset($_POST['register'])) {
	
	$fname = $_POST['fname'];
	$sname = $_POST['sname'];
	$uname = $_POST['uname'];
	$gender = $_POST['gender'];
	$pass = $_POST['pass'];
	$c_pass = $_POST['c_pass'];

	$error = array();

	if (empty($fname)) {
		$error['error'] = "Firstname is Empty";
	}else if(empty($sname)){
		$error['error'] = "Surname is empty";
	}else if(empty($uname)){
		$error['error'] = "username is empty";
	}else if(empty($gender)){
		$error['error'] = "Select Gender";
	}else if(empty($pass)){
		$error['error'] = "Enter Password";
	}else if(empty($c_pass)){
		$error['error'] = "Confirm Password";
	}else if($pass != $c_pass){
		$error['error'] = "Both password do not match";
	}


	if (isset($error['error'])) {
		$output .= $error['error'];
	}else{
		$output .= "";
	}


	if (count($error) < 1) {
		
		$query = "INSERT INTO users(firstname,surname,username,gender, role, password) VALUES('$fname','$sname','$uname','$gender', 'student', '$pass')";
		$res = mysqli_query($connect,$query);

		if ($res) {
			$output .= "You have successfully registered";
			header("Location:index.php");
		}else{
			$output .= "Failed to register";
		}
	}
}



 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>
	<?php include("includes/header_links.php"); ?>
</head>
<body>

	<?php include("includes/header_navigation.php"); ?>


	<div class="container">
		<div class="col-md-12">
			<div class="row d-flex justify-content-center">
				<div class="col-md-6 shadow-sm" style="margin-top:100px;">
					<form method="post">
						<h3 class="text-center my-3">Register</h3>

						<div class="text-center"><?php echo $output; ?></div>

						<label>First name</label>
						<input type="text" name="fname" class="form-control my-2" placeholder="Enter Firstname" autocomplete="off">

						<label>Surname</label>
						<input type="text" name="sname" class="form-control my-2" placeholder="Enter Surname" autocomplete="off">


						<label>Username</label>
						<input type="text" name="uname" class="form-control my-2" placeholder="Enter Username" autocomplete="off">

                        <label>Select Gender</label>
						<select class="form-control my-2" name="gender">
							<option value="">Select Gender</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
                            <option value="Non-binary">Non-binary</option>
						</select>

						<label>Password</label>
						<input type="password" name="pass" class="form-control my-2" placeholder="Enter Password">

						<label>Confirm Password</label>
						<input type="password" name="c_pass" class="form-control my-2" placeholder="Enter Confirm Password">

						<input type="submit" name="register" class="btn btn-success" value="Register">
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="" style="margin-top: 30px;"></div>

</body>
</html>