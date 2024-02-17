<?php 

include 'config.php';

if (isset($_POST['submit'])) {

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, hash("sha256", $_POST['password']));
	$cpass = mysqli_real_escape_string($conn, hash("sha256", $_POST['cpassword']));
	// $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
	// $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
	$user_type = $_POST['user_type'];

	$select_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' ");
	//$select_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$pass' ");

	if (mysqli_num_rows($select_users) > 0){
		$message[] = 'User already exists!';
	}else{
		if ($pass != $cpass) {
			$message[] = 'password not matches!';
		}else{
			mysqli_query($conn, "INSERT INTO users(name, email, password, user_type) 
				VALUES('$name', '$email', '$cpass', '$user_type')");
			header("location:login.php");
			$message[] = 'user registered!';
		}
	}

	


	// if (mysqli_num_rows($select_users) > 0) {
	// 	$message[] = 'user already exists!';
	// }else{
	// 	if ($pass != $cpass) {
	// 		$message[] = 'confirm password not matched!';
	// 	}else{
	// 		mysqli_query($conn, "INSERT INTO ´users´(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die("query failed");
	// 		$message[] = 'registered succesfully!';
	// 	}
	// }
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>register</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>




<?php 

if (isset($message)) {
	foreach($message as $message) {
		echo '
			<div class="message">
				<span>'.$message.'</span>
				<i onclick="this.parentElement.remove()">X</i>
			</div>
		';
	}
}

 ?>

	<div class="form-container">
		<form action="" method="POST">
			<h3>Register Now</h3>
			<input type="text" name="name" placeholder="enter your name" required class="box">
			<input type="email" name="email" placeholder="enter your email" required class="box">
			<input type="password" name="password" placeholder="enter your password" required class="box">
			<input type="password" name="cpassword" placeholder="confirm your password" required class="box">
			<select name="user_type" class="box">
				<option value="user">user</option>
				<option value="admin">admin</option>
			</select>
			<input type="submit" name="submit" value="register now" class="btn">
			<p>already have an account? <a href="login.php">login now</a></p>
			
		</form>
	</div>

</body>
</html>