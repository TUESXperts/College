<?php
    session_start();

include("includes/connection.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>
	<?php include("includes/header_links.php"); ?>

	<style>
	
	 *,
        *::before,
        *::after {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            margin: 0;
            padding: 10px;
        }

        .dropdown {
            margin: 0;
            padding: 0;
            list-style: none;
            width: 100px;
            background-color: #0abf53;
        }

        .dropdown li {
            position: relative;
        }

        .dropdown li a {
            color: #ffffff;
            text-align: center;
            text-decoration: none;
            display: block;
            padding: 10px;
        }

        .dropdown li ul {
            position: absolute;
            top: 100%;
            margin: 0;
            padding: 0;
            list-style: none;
            display: none;
            line-height: normal;
            background-color: #333;
        }

        .dropdown li ul li a {
            text-align: center;
            color: #cccccc;
            font-size: 14px;
            padding: 10px;
            display: block;
            white-space: nowrap;
        }

        .dropdown li ul li a:hover {
            background-color: #0abf53;
            color: #ffffff;
        }

        .dropdown li ul li ul {
            left: 100%;
            top: 0;
        }

        ul li:hover>a {
            background-color: #0abf53;
            color: #ffffff !important;
        }

        ul li:hover>ul {
            display: block;
        }

        .block {
	  display: block;
	  width: 100%;
	  border: none;
	  background-color: #04AA6D;
	  color: white;
	  padding: 14px 28px;
	  font-size: 16px;
	  cursor: pointer;
	  text-align: center;
	}

	.block:hover {
	  background-color: #ddd;
	  color: black;
	}

	.form-group {
		margin-bottom: 20px;
	}

	a {
		text-decoration: none;
		color: white;
	}
    
	</style>
</head>
<body>

	<?php include("includes/header_navigation.php"); ?>

	<h2 style="text-align: center;">Please, choose a faculty!</h2>
	 <form>
	 	<?php 
                	$query_faculty = "SELECT id, name FROM faculties";
			         $res_faculty = mysqli_query($connect,$query_faculty);

			         while ($row = mysqli_fetch_assoc($res_faculty)) { 
			         	$faculty_id = $row['id'];
			         ?>
			         	<div class="form-group">
			         		
								<button class="block"> <a href="faculty.php?faculty_id=<?=$faculty_id?>"><?=$row['name']?></a></button>
							
						</div>
						<?php
			         }
		?>

		
	</form>
	
                
</body>
</html>