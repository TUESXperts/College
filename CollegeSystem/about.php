<?php
    session_start();

include("includes/connection.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
	<title>About us</title>

	<style>
* {
  box-sizing: border-box;
}

.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
    <?php include("includes/header_links.php"); ?>
</head>
<body>
	<?php include("includes/header_navigation.php"); ?>

    <!-- Banner Image  -->
    <div
      class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center"
    >
      <!--<div class="content text-center">
        <h1 class="text-white">|C O L L E G E  |  S Y S T E M|</h1>
      </div> -->
    </div>

	<header class="bg-dark py-5">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center my-5">
                            <h1 class="display-5 fw-bolder text-white mb-2">Welcome to Dexter's Lab</h1>
                            <p class="lead text-white-50 mb-4">We care for you and your family!</p>
                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Features section-->
        <section class="py-5 border-bottom" id="features">
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
                        <h2 class="h4 fw-bolder">Preventive tests</h2>
                        <p>Minimize the risk of developing chronic diseases and permanent injuries through regular health prevention.</p>
                    </div>

                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                        <h2 class="h4 fw-bolder">Hormonal tests</h2>
                        <p>Over 16% of the Bulgarian population has thyroid problems and is unaware of their presence. Get tested in time and prevent future complications!</p>
                    </div>

                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                        <h2 class="h4 fw-bolder">Sexually transmitted diseases</h2>
                        <p>Using the latest technologies in combination with international professionalism, we provide you with a quick diagnosis of the full range of sexually transmitted diseases.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-light py-5 border-bottom">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bolder">Services and Prices</h2>
                    <p class="lead mb-0">Please, don't say "damnnn..." when you see the prices!</p>
                </div>
                <div class="row">
                	<div class="column">
                 
                    <table class="table table-striped">
            		<thead>
		                <tr>
		                	<h4 style="text-align: center">Category: Hematology</h4>
		                  	<th scope="col">#</th>
			                <th scope="col">Service</th>
			                <th scope="col">Price</th>
		                </tr>
		            </thead>
		            <tbody>

		                <?php

		                    $sql="SELECT * FROM services WHERE category='hematology'";
		                    $result=mysqli_query($connect, $sql);
		                    if($result) {
		                        $i = 1;
		                        while($row=mysqli_fetch_assoc($result)) {
		                            $id=$row['id'];
		                            $service=$row['service'];
		                            $price=$row['price'];
		                            $category=$row['category'];
		                            
		                            echo '
		                                <tr>
		                                    <th scope="row">' . $i . '</th>
		                                    <td>'.$service.'</td>
		                                    <td>'.$price.'</td>
		                                </tr>
		                            ';
		                            $i++;
		                        }
		                    }
		    
		                ?>
		            </tbody>
		        </table>
                   </div>

                   <div class="column">
                 
                    <table class="table table-striped">
            		<thead>
		                <tr>
		                	<h4 style="text-align: center">Category: Coagulation</h4>
		                  	<th scope="col">#</th>
			                <th scope="col">Service</th>
			                <th scope="col">Price</th>
		                </tr>
		            </thead>
		            <tbody>

		                <?php

		                    $sql="SELECT * FROM services WHERE category='coagulation'";
		                    $result=mysqli_query($connect, $sql);
		                    if($result) {
		                        $i = 1;
		                        while($row=mysqli_fetch_assoc($result)) {
		                            $id=$row['id'];
		                            $service=$row['service'];
		                            $price=$row['price'];
		                            $category=$row['category'];
		                            
		                            echo '
		                                <tr>
		                                    <th scope="row">' . $i . '</th>
		                                    <td>'.$service.'</td>
		                                    <td>'.$price.'</td>
		                                </tr>
		                            ';
		                            $i++;
		                        }
		                    }
		    
		                ?>
		            </tbody>
		        </table>
                   </div>
                </div>
            </div>
        </section>
   
        <section class="bg-light py-5">
            <div class="container px-5 my-5 px-5">
                <div class="text-center mb-5">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                    <h2 class="fw-bolder">Get in touch</h2>
                    <p class="lead mb-0">We'd love to hear from you</p>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-6">
                   
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">Full name</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Email address</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                <label for="phone">Phone number</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Message</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container px-5"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
</body>
</html>