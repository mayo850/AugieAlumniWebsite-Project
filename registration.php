<?php 
$username = $confirmPassword = $dob = $augieID = $gradYear= $firstName = $lastName = $phone = $city = $workPlace = $email = $password = "";
$usernameErr = $passwordErr = $dobErr = $cityErr = $emailErr = $gradYearErr = $lastNameErr = $firstNameErr = $workPlaceErr = $cityErr = $IDErr = $phoneNumErr = $formErr = $formSuccess = " ";

$validInput = true;

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$servername = "localhost";
$login = "root";
$password = "";
$dbname = "augiealumni";
// Create connection
$conn = new mysqli($servername, $login, $password, $dbname);


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->validateInputconnect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = test_input($_POST["username"]);
  $email = test_input($_POST["email"]);
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  $gradYear = test_input($_POST["gradYear"]);
  $workPlace = test_input($_POST["workPlace"]);
  $city = test_input($_POST["location"]);
  $phone = test_input($_POST["phone"]);
  $firstName = test_input($_POST["firstName"]);
  $lastName = test_input($_POST["lastName"]);
  $dob = test_input($_POST["dob"]);
  $augieID = test_input($_POST["ID"]);
  $password = test_input($_POST["password"]);
  $confirmPassword = test_input($_POST["confirmPassword"]);


  $sql= "SELECT username FROM users";

  $query = mysqli_query($conn,$sql);

  $result = $query->fetch_assoc();


  if (empty($username)) {
    $usernameErr = "*Username is required";
    $validInput = False;
  } elseif ($result != null) {
    if (in_array($username, $result))  {
    $usernameErr = "*Username is taken";
    $validInput = False;
  } }

  if (empty($gradYear)) {
    $gradYearErr = "*Graduation year is required";
    $validInput = False;
  } elseif (filter_var($phone, FILTER_SANITIZE_NUMBER_INT) === false) {
    $gradYearErr = "*Graduation year should be a number";
    $validInput = False;
  }

  if (empty($firstName)) {
    $firstNameErr = "*First name is required";
    $validInput = False;
  } elseif (!(preg_match('/[\'^£$%&*()}{@#~?><!>,|=_+¬-]/', $firstName) == 0 && preg_match('/\d/', $firstName) == 0)) {
    $firstNameErr = "*First name should only contain letters";
  }

  if (empty($lastName)) {
    $lastNameErr = "*Last name is required";
    $validInput = False;
  } elseif (!(preg_match('/[\'^£$%&*()}{@#~?><!>,|=_+¬-]/', $lastName) == 0 && preg_match('/\d/', $lastName) == 0)) {
    $lastNameErr = "*Last name should only contain letters";
  }

  if (empty($phone)) {
    $phoneNumErr = "*Phone Number is required";
    $validInput = False;
  } elseif (filter_var($phone, FILTER_SANITIZE_NUMBER_INT) === false) {
    $phoneNumErr = "*Phone number should be a number";
  }


  $sql= "SELECT email FROM users";

  $query = mysqli_query($conn,$sql);

  $result = $query->fetch_assoc();



  if (empty($email)) {
    $emailErr = "*Email is required";
    $validInput = False;
  } elseif (filter_var($email, FILTER_SANITIZE_EMAIL) === false) {
    $emailErr = "*Email is not valid";
    $validInput = False;
  } elseif ($result != null) {
    if (in_array($email, $result)) {
    $emailErr = "*Email is already taken";
    $validInput = False;
  } }

  if (empty($dob)) {
    $dobErr = "*Date of birth is required";
    $validInput = False;
  }



  $sql= "SELECT augieID FROM users";

  $query = mysqli_query($conn,$sql);

  $result = $query->fetch_assoc();



  if (empty($augieID)) {
    $IDErr = "*Augie ID is required";
    $validInput = False;
  } elseif (filter_var($augieID, FILTER_SANITIZE_NUMBER_INT) === false) {
    $IDErr = "*Augie ID should be a number";
    $validInput = False;
  } elseif ($result != null) {
    if (in_array($augieID, $result)) {
    $IDErr = "*Augie ID is already registered";
    $validInput = False;
  } }

  if (empty($workPlace)) {
    $workPlaceErr = "*Work Place is required";
    $validInput = False;
  } elseif(!(preg_match('/[\^£$%&*()}{@#~?><!>,|=_+¬-]/', $workPlace) == 0)) {
    $workPlaceErr = "*Work place shouldn't contain special characters";
    $validInput = False;
  }

  if (empty($city)) {
    $cityErr = "*Location is required";
    $validInput = False;
  } elseif(!(preg_match('/[\'^£$%&*()}{@#~?><!>,|=_+¬-]/', $city) == 0 && preg_match('/\d/', $city) == 0)) {
    $cityErr = "*Location should only contain letters";
    $validInput = False;
  }

  if (empty($password)) {
    $passwordErr = "*Password is required";
    $validInput = False;
  } elseif (preg_match("/[A-Z]/", $password) == 1 && preg_match("/[a-z]/", $password) == 1 && preg_match("/\d/", $password) == 1 ) {
    if (preg_match('/[\'^£$%&*()}{@#~?><!>,|=_+¬-]/', $password) == 0) {
      $passwordErr = "*Password must contain atleast 1 uppercase letter, atleast 1 lowercase letter, atleast 1 number, and atleast 1 special character";
      $validInput = False;
    } elseif ($password != $confirmPassword) {
      $validInput = False;
      $passwordErr = "*Passwords do not match";
    } 

  } else {
      $passwordErr = "*Password must contain atleast 1 uppercase letter, atleast 1 lowercase letter, atleast 1 number, and atleast 1 special character";
      $validInput = False;
  }

  $password = password_hash($password, PASSWORD_BCRYPT);




if($validInput) {
  $sql = "INSERT INTO users (username, email, gradYear, workPlace, city, phoneNumber, firstName, lastName, dob, augieID, password) VALUES ('$username', '$email', '$gradYear' ,'$workPlace', '$city', '$phone', '$firstName', '$lastName', '$dob', '$augieID', '$password')";

  if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();

if (!$validInput) {
  $formErr = "Account could not be created";
} else {
  $formSuccess = "Account created";
}

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/reg.css" />
    <script src="js/reg.js" defer></script>
    <title>Viking Registration Form</title>
  </head>
  <body background= "images/old.jpg">
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form">
    <h2 id="message" style="color:red;"> <?php echo $formErr;?></h2>
    <h2 id="message" style="color:green;"> <?php echo $formSuccess;?></h2>
      <h1 class="text-center">Registration Form</h1>
      <!-- Progress bar -->
      <div class="progressbar">
        <div class="progress" id="progress"></div>

        <div
          class="progress-step progress-step-active"
          data-title="Intro"
        ></div>
        <div class="progress-step" data-title="Name"></div>
        <div class="progress-step" data-title="Contact"></div>
        <div class="progress-step" data-title="ID"></div>
        <div class="progress-step" data-title="Employment"></div>
        <div class="progress-step" data-title="Password"></div>
      </div>

      <!-- Steps -->
      <div class="form-step form-step-active">
        <div class="input-group">
        <span class="error" style="color:red;"> <?php echo $usernameErr;?></span>
          <label for="username">Username</label>
          <input type="text" name="username" id="username" />
        </div>

        <div class="input-group">
        <span class="error" style="color:red;"> <?php echo $gradYearErr;?></span>
          <label for="gradYear">Graduation Year</label>
          <input type="text" name="gradYear" id="gradYear" />
        </div>

        <div class="">
          <a href="#" class="btn btn-next width-50 ml-auto">Next</a>
        </div>
      </div>

      <div class="form-step">
        <div class="input-group">
        <span class="error" style="color:red;"> <?php echo $firstNameErr;?></span>
          <label for="firstName">First Name</label>
          <input type="text" name="firstName" id="firstName" />
        </div>

        <div class="input-group">
        <span class="error" style="color:red;"> <?php echo $lastNameErr;?></span>
          <label for="lastName">Last Name</label>
          <input type="text" name="lastName" id="lastName" />
        </div>

        <div class="btns-group">
          <a href="#" class="btn btn-prev">Previous</a>
          <a href="#" class="btn btn-next">Next</a>
        </div>
      </div>

      <div class="form-step">
        <div class="input-group">
        <span class="error" style="color:red;"> <?php echo $phoneNumErr;?></span>
          <label for="phone">Phone</label>
          <input type="text" name="phone" id="phone" />
        </div>

        <div class="input-group">
        <span class="error" style="color:red;"> <?php echo $emailErr;?></span>
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
        <span class="error" style="color:red;"> <?php echo $dobErr;?></span>
          <label for="dob">Date of Birth</label>
          <input type="date" name="dob" id="dob" />
        </div>

        <div class="input-group">
        <span class="error" style="color:red;"> <?php echo $IDErr;?></span>
          <label for="ID">Augie ID</label>
          <input type="number" name="ID" id="ID" />
        </div>

        <div class="btns-group">
          <a href="#" class="btn btn-prev">Previous</a>
          <a href="#" class="btn btn-next">Next</a>
        </div>
      </div>



      <div class="form-step">
        <div class="input-group">
        <span class="error" style="color:red;"> <?php echo $workPlaceErr;?></span>
          <label for="workPlace">Currently Working At:</label>
          <input type="text" name="workPlace" id="workPlace" />
        </div>

        <div class="input-group">
        <span class="error" style="color:red;"> <?php echo $cityErr;?></span>
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
        <span class="error" style="color:red;"> <?php echo $passwordErr;?></span>
          <label for="password">Password</label>
          <input type="password" name="password" id="password" />
        </div>

        <div class="input-group">
          <label for="confirmPassword">Confirm Password</label>
          <input
            type="password"
            name="confirmPassword"
            id="confirmPassword"
          />
        </div>

        <div class="btns-group">
          <a href="#" class="btn btn-prev">Previous</a>
          </form>
          <input type="submit" value="Submit" class="btn"/>
        </div>
      </div>
  </body>
</html>
