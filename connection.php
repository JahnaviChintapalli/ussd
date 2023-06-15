<?php
$con = mysqli_connect("localhost","my_user","my_password","my_db");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
// Perform query
if ($result = mysqli_query($con, "SELECT * FROM Persons")) {
  echo "Returned rows are: " . mysqli_num_rows($result);
  // Free result set
 mysqli_free_result($result);
}
mysqli_close($con);
?>