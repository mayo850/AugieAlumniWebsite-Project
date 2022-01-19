<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		$gradYear = $_POST['gradYear'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $major = $_POST['major'];
        $augie_ID = $_POST['augie_ID'];
        $workPlace = $_POST['workPlace'];
        $location = $_POST['location'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//save to database
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,password,gradYear,phone,email,major,augie_ID,workPlace,location) values ('$user_id','$user_name','$password', '$gradYear', '$phone', '$email', '$major', '$augie_ID','$workPlace', '$location')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/reg.css" />
    <script src="js/reg.js" defer></script>
    <title>Viking Registraion Form</title>
  </head>
  <body background= "images/old.jpg">
    <form method="post" class="form" >
      <h1 class="text-center">Registration Form</h1>
      <!-- Progress bar -->
      <div class="progressbar">
        <div class="progress" id="progress"></div>

        <div
          class="progress-step progress-step-active"
          data-title="Intro"
        ></div>
        <div class="progress-step" data-title="Contact"></div>
        <div class="progress-step" data-title="ID"></div>
        <div class="progress-step" data-title="Employment"></div>
        <div class="progress-step" data-title="Password"></div>
      </div>

      <!-- Steps -->
      <div class="form-step form-step-active">
        <div class="input-group">
          <label for="user_name">Username</label>
          <input type="text" name="user_name" id="user_name" />
        </div>
        <div class="input-group">
          <label for="gradYear">Graduation Year</label>
          <input type="number" name="gradYear" id="gradYear" />
        </div>
        <div class="">
          <a href="#" class="btn btn-next width-50 ml-auto">Next</a>
        </div>
      </div>
      <div class="form-step">
        <div class="input-group">
          <label for="phone">Phone</label>
          <input type="number" name="phone" id="phone" />
        </div>
        <div class="input-group">
          <label for="email">Email</label>
          <input type="text" name="email" id="email" />
        </div>
        <div class="btns-group">
          <a href="#" class="btn btn-prev">Previous</a>
          <a href="#" class="btn btn-next">Next</a>
        </div>
      </div>
      <div class="form-step">
        <div class="input-group">
          <label for="major">Major(s)</label>
          <input type="text" name="major" id="major" />
        </div>
        <div class="input-group">
          <label for="augie_ID">Augie ID</label>
          <input type="number" name="augie_ID" id="augie_ID" />
        </div>
        <div class="btns-group">
          <a href="#" class="btn btn-prev">Previous</a>
          <a href="#" class="btn btn-next">Next</a>
        </div>
      </div>
      <div class="form-step">
        <div class="input-group">
          <label for="workPlace">Currently Working At:</label>
          <input type="text" name="workPlace" id="workPlace" />
        </div>
        <div class="input-group">
          <label for="location">Location</label>
          <input type="text" name="location" id="location" />
        </div>
        <div class="btns-group">
          <a href="#" class="btn btn-prev">Previous</a>
          <a href="#" class="btn btn-next">Next</a>
        </div>
      </div>
      <div class="form-step">
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" />
        </div>
        <div class="btns-group">
          <a href="#" class="btn btn-prev">Previous</a>
          <input type="submit" name="Submit" id="Submit" value="Submit">
        </div>
        <a href = login.php>Login Page</a>
      </div>
    </form>
  </body>
</html>