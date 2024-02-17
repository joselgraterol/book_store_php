<?php 
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
	header("location:login.php");
}
 ?>


 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>admin panel</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'admin_header.php'; ?>

<!-- admin dashboard starts -->

<section class="dashboard">

	<h1 class="title">Dashboard</h1>

	<div class="box-container">

		<!-- pendings -->
		<div class="box">
			<?php 

				$total_pendings = 0;
				$select_pending = mysqli_query($conn, "SELECT total_price FROM orders 
					WHERE payment_status = 'pending' ");

				if (mysqli_num_rows($select_pending) > 0) {
					while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
						$total_price = $fetch_pendings["total_price"];
						$total_pendings += $total_price;
					}
				}

			?>

			<h3>$<?php echo $total_pendings; ?></h3>
			<p>total pendings</p>
			
		</div>

		<!-- completed -->
		<div class="box">
			<?php 

				$total_completed = 0;
				$select_completed = mysqli_query($conn, "SELECT total_price FROM orders 
					WHERE payment_status = 'completed' ");

				if (mysqli_num_rows($select_completed) > 0) {
					while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
						$total_price = $fetch_completed["total_price"];
						$total_completed += $total_price;
					}
				}

			?>

			<h3>$<?php echo $total_completed; ?></h3>
			<p>completed payments</p>
			
		</div>

		<!-- orders -->
		<div class="box">
			<?php 

				$select_orders = mysqli_query($conn, "SELECT * FROM orders") or die("query failed");
				$number_of_orders = mysqli_num_rows($select_orders);
			?>

			<h3><?php echo $number_of_orders; ?></h3>
			<p>order placed</p>
		</div>


		<!-- products -->
		<div class="box">
			<?php 

				$select_products = mysqli_query($conn, "SELECT * FROM products") or die("query failed");
				$number_of_products = mysqli_num_rows($select_products);
			?>

			<h3><?php echo $number_of_products; ?></h3>
			<p>products added</p>
		</div>

		<!-- normal users -->
		<div class="box">
			<?php 

				$select_users = mysqli_query($conn, "SELECT * FROM users 
					WHERE user_type = 'user' ") or die("query failed");
				$number_of_users = mysqli_num_rows($select_users);
			?>

			<h3><?php echo $number_of_users; ?></h3>
			<p>normal users</p>
		</div>

		<!-- admins -->
		<div class="box">
			<?php 

				$select_admins = mysqli_query($conn, "SELECT * FROM users 
					WHERE user_type = 'admin' ") or die("query failed");
				$number_of_admins = mysqli_num_rows($select_admins);
			?>

			<h3><?php echo $number_of_admins; ?></h3>
			<p>admin users</p>
		</div>


		<!-- total users -->
		<div class="box">
			<?php 

				$select_account = mysqli_query($conn, "SELECT * FROM users ") or die("query failed");
				$number_of_account = mysqli_num_rows($select_account);
			?>

			<h3><?php echo $number_of_account; ?></h3>
			<p>total users</p>
		</div>

		<!-- total messages -->
		<div class="box">
			<?php 

				$select_messages = mysqli_query($conn, "SELECT * FROM message ") or die("query failed");
				$number_of_messages = mysqli_num_rows($select_messages);
			?>

			<h3><?php echo $number_of_messages; ?></h3>
			<p>new messages</p>
		</div>
		
	</div>
	
</section>


<!-- admin dashboard ends -->



<script src="admin_script.js"></script>
</body>
</html>