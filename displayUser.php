<?php
    $username = "";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST["username"]);
    }

$servername = "localhost";
$login = "root";
$password = "";
$dbname = "augiealumni";

$conn = new mysqli($servername, $login, $password, $dbname);
if ($conn->connect_error) {
  die('Could not connect: ' . $conn->validateInputconnect_error());
}

$sql= "SELECT * FROM users WHERE username  = '$username'";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result)) {
    echo "<div class='image'>";
        echo "<h1>" . $row['firstName'] . " " . $row['lastName'] . "</h1>";
        echo "<img onerror='this.onerror=null; this.src=`images/default.jpg`' src='images/" . $row['username'] .".jpg' width=200 height=200></img>";
    echo "</div>";

    echo "<div class='info'>";
        echo "<table>";
            echo "<tr><td> First Name </td>";
            echo "<td>" . $row['firstName'] . "</td></tr>";
            
            echo "<tr><td> Last Name </td>";
            echo "<td>" . $row['lastName'] . "</td></tr>";

            echo "<tr><td> Username </td>";
            echo "<td>" . $row['username'] . "</td></tr>";

            echo "<tr><td> Email </td>";
            echo "<td>" . $row['email'] . "</td></tr>";

            echo "<tr><td> Phone Number </td>";
            echo "<td>" . $row['phoneNumber'] . "</td></tr>";

            echo "<tr><td> Graduation Year </td>";
            echo "<td>" . $row['gradYear'] . "</td></tr>";

            echo "<tr><td> Works at </td>";
            echo "<td>" . $row['workPlace'] . "</td></tr>";

            echo "<tr><td> Lives in </td>";
            echo "<td>" . $row['city'] . "</td></tr>";

            echo "<tr><td> Birth Day </td>";
            echo "<td>" . $row['dob'] . "</td></tr>";

        echo "</table>";

    echo "</div>";
}




?>