<?php

$servername = "localhost"; //change to dmap server later
$username = "root"; //change to dmap db username later
$password = ""; // change to dmap db password later
$db_name = "myproject"; //change to dmap db name later
$user = $_POST['username'];
$pass = $_POST['password'];
$message = "Invalid username or password.";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db_name);

// Check connection
if (mysqli_connect_error()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//check username and password
$results = $conn->query("SELECT * FROM admin WHERE username = '$user' and password = '$pass'");
$obj = $results->fetch_array();
if($user == $obj['username'] && $pass = $obj['password']){
	//echo "Welcome to admin ".$obj['first_name'];
	//echo "!";
	header("location:admin.php");
} else {
	//echo "Invalid username or password.";
	
	echo "<script>alert('Invalid username or password.'); parent.location.href = './login.html'</script>";
	//include('login.php');
	//header("location:login.php");

}
?>
