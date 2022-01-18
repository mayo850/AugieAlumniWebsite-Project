<?php
$q = $_GET['users'];

$servername = "localhost";
$login = "root";
$password = "";
$dbname = "augiealumni";

$conn = new mysqli($servername, $login, $password, $dbname);
if ($conn->connect_error) {
  die('Could not connect: ' . $conn->validateInputconnect_error());
}

$sql= "SELECT * FROM users WHERE firstName LIKE '%$q%' OR lastName LIKE '%$q%'";
$result = mysqli_query($conn,$sql);

echo "<table>";
echo "<tr>";
echo "<th> Image </th>";
echo "<th> First Name </th>";
echo "<th> Last Name </th>";
echo "<th> Username </th>";
echo "<th> Year Graduated </th>";
echo "</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr><td>" . "<img  src='images/" . $row['username'] .".jpg' onerror='this.onerror=null; this.src=`images/default.jpg`' width=200 height=200></img>";
  echo "</td> <td>" . $row['firstName'] . "</td> <td> ". $row['lastName'] . "</td> <td>" . $row['username'] . "</td> <td>";
  echo $row['gradYear'] . "</td> <td>" ."<form action='displayUser.php' method='post'><input name='username' type='hidden' value='" . $row['username'] . "'></input><input type='submit' value='Go to Profile'></input></td></form></tr>";
}

echo "</table>";
mysqli_close($conn);
?>

