<?php
    $username = "";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_name = test_input($_POST["user_name"]);
    }

$servername = "localhost";
$login = "root";
$password = "";
$dbname = "login_sample_db";

$conn = new mysqli($servername, $login, $password, $dbname);
if ($conn->connect_error) {
  die('Could not connect: ' . $conn->validateInputconnect_error());
}

$sql= "SELECT * FROM users WHERE user_name  = '$user_name'";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result)) {
    echo "<div class='image'>";
        echo "<img onerror='this.onerror=null; this.src=`images/default.jpg`' src='images/" . $row['user_name'] .".jpg' width=200 height=200></img>";
    echo "</div>";

    echo "<div class='info'>";
        echo "<table>";
            echo "<tr><td> Username </td>";
            echo "<td>" . $row['user_name'] . "</td></tr>";

            echo "<tr><td> Email </td>";
            echo "<td>" . $row['email'] . "</td></tr>";

            echo "<tr><td> Phone Number </td>";
            echo "<td>" . $row['phone'] . "</td></tr>";

            echo "<tr><td> Graduation Year </td>";
            echo "<td>" . $row['gradYear'] . "</td></tr>";

            echo "<tr><td> Works at </td>";
            echo "<td>" . $row['workPlace'] . "</td></tr>";

            echo "<tr><td> Lives in </td>";
            echo "<td>" . $row['location'] . "</td></tr>";

        echo "</table>";

    echo "</div>";
}




?>