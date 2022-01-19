<?php
$q = $_GET['users'];

$servername = "localhost";
$login = "root";
$password = "";
$dbname = "login_sample_db";

$conn = new mysqli($servername, $login, $password, $dbname);
if ($conn->connect_error) {
  die('Could not connect: ' . $conn->validateInputconnect_error());
}

$sql= "SELECT * FROM users WHERE user_name LIKE '%$q%'";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) == 0) {
  echo "<h1>No Users Found";
} else {
    echo "<table>";
    echo "<tr>";
    echo "<th> Image </th>";
    echo "<th> Username </th>";
    echo "<th> Year Graduated </th>";
    echo "</tr>";
    while($row = mysqli_fetch_array($result)) {
      echo "<tr><td>" . "<img  src='images/" . $row['user_name'] .".jpg' onerror='this.onerror=null; this.src=`images/default.jpg`' width=200 height=200></img>";
      echo "</td> <td>" . $row['user_name'] . "</td> <td>";
      echo $row['gradYear'] . "</td> <td>" ."<form action='displayUser.php' method='post'><input name='user_name' type='hidden' value='" . $row['user_name'] . "'></input><input type='submit' value='Go to Profile'></input></td></form></tr>";
    }
    echo "</table>";
  }
  
mysqli_close($conn);
?>
