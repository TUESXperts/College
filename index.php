<?php 
  session_start();
  include("includes/connection.php");

   
   $output = "";

  if (isset($_POST['login'])) {
  	   
  	   $uname = $_POST['uname'];
  	   $pass = $_POST['pass'];

  	   if (empty($uname)) {
  	   	
  	   }else if(empty($pass)){

  	   }else{

         $query = "SELECT id,username, firstname, surname, role FROM users WHERE username='$uname' AND password='$pass' limit 1";
         $res = mysqli_query($connect,$query);

         if (mysqli_num_rows($res) == 1) {
              $result = mysqli_fetch_assoc($res);
              $role = $result['role'];
              //echo 'firstname' . $result['firstname'];
              $_SESSION['user_id'] = $result['id'];
              $_SESSION['firstname'] = $result['firstname'];
              $_SESSION['surname'] = $result['surname'];
              $_SESSION['username'] = $result['username'];
              $_SESSION['role'] = $result['role'];
              $_SESSION['role_redirect'] = "views/" . $result['role'] . "_view" . ".php";
              //print_r($_SESSION);
              header("Location: " . $_SESSION['role_redirect']);

         	 $output .= "you have logged-In";
         }else{
             $output .= "Failed to login";
         }

  	   }
  }




 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
    <?php include("includes/header_links.php"); ?>
</head>
<body>
<?php include("includes/header_navigation.php"); ?>

	<div class="container">
		<div class="col-md-12">
			<div class="row d-flex justify-content-center">
				<div class="col-md-6 shadow-sm" style="margin-top:100px;">
					<form method="post" style="padding: 20px;">
						<h3 class="text-center my-3">Login</h3>
						<div class="text-center"><?php echo $output; ?></div>
						<label>Username</label>
						<input type="text" name="uname" class="form-control my-2" placeholder="Enter Username" autocomplete="off" value="admin">

						<label>Password</label>
						<input type="password" name="pass" class="form-control my-2" placeholder="Enter Password" value="admin">

						<input type="submit" name="login" class="btn btn-success" value="Login">
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>