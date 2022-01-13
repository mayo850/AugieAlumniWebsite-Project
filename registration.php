<?php 
$username = $dob = $augieID = $gradYear= $firstName = $lastName = $phone = $city = $workPlace = $email = $password = "";



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
  $gradYear = test_input($_POST["gradYear"]);
  $workPlace = test_input($_POST["workPlace"]);
  $city = test_input($_POST["location"]);
  $phone = test_input($_POST["phone"]);
  $firstName = test_input($_POST["firstName"]);
  $lastName = test_input($_POST["lastName"]);
  $dob = test_input($_POST["dob"]);
  $augieID = test_input($_POST["ID"]);
  $password = password_hash(test_input($_POST["password"]), PASSWORD_BCRYPT);
}

$sql = "INSERT INTO users (username, email, gradYear, workPlace, city, phoneNumber, firstName, lastName, dob, augieID, password) VALUES ('$username', '$email', '$gradYear' ,'$workPlace', '$city', '$phone', '$firstName', '$lastName', '$dob', '$augieID', '$password')";

if ($conn->query($sql) === TRUE) {
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/reg.css" />
    <script src="js/reg.js" defer></script>
    <title>Viking Registraion Form</title>
  </head>
  <body background= "images/old.jpg">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form">
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
          <label for="username">Username</label>
          <input type="text" name="username" id="username" />
        </div>

        <div class="input-group">
          <label for="gradYear">Graduation Year</label>
          <input type="text" name="gradYear" id="gradYear" />
        </div>

        <div class="">
          <a href="#" class="btn btn-next width-50 ml-auto">Next</a>
        </div>
      </div>

      <div class="form-step">
        <div class="input-group">
          <label for="firstName">First Name</label>
          <input type="text" name="firstName" id="firstName" />
        </div>

        <div class="input-group">
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
          <label for="phone">Phone</label>
          <input type="text" name="phone" id="phone" />
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
          <label for="dob">Date of Birth</label>
          <input type="date" name="dob" id="dob" />
        </div>

        <div class="input-group">
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
          <input type="submit" value="Submit" class="btn" />
        </div>
      </div>


    </form>
  </body>
</html>
