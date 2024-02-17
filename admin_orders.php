<?php 
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
	header("location:login.php");
}


if (isset($_POST['update_order'])) {

	$order_update_id = $_POST['order_id'];
	$update_payment = $_POST['update_payment'];
	mysqli_query($conn, "UPDATE orders SET payment_status = '$update_payment' 
		WHERE id = '$order_update_id' ") or die("query failed");
	$message[] = 'payment status has been updated';
}

if (isset($_GET['delete'])) {
	$delete_id = $_GET['delete'];
	mysqli_query($conn, "DELETE FROM orders WHERE id = '$delete_id' ") or die("query failed");
	header("location:admin_orders.php");
}


?>


 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'admin_header.php'; ?>


<section class="orders">

	<h1 class="title">placed orders</h1>

	<div class="box-container">
		<?php 
		$select_orders = mysqli_query($conn, "SELECT * FROM orders") or die("query failed");

		if (mysqli_num_rows($select_orders) > 0) {
			while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {

		?>
		<div class="box">
			<p>user id: <?php echo $fetch_orders["user_id"]; ?></p>
			<p>placed on: <?php echo $fetch_orders["placed_on"]; ?></p>
			<p>name: <?php echo $fetch_orders["name"]; ?></p>
			<p>number: <?php echo $fetch_orders["number"]; ?></p>
			<p>email: <?php echo $fetch_orders["email"]; ?></p>
			<p>address: <?php echo $fetch_orders["address"]; ?></p>
			<p>total products: <?php echo $fetch_orders["total_products"]; ?></p>
			<p>total price: $<?php echo $fetch_orders["total_price"]; ?></p>
			<p>payment method: <?php echo $fetch_orders["method"]; ?></p>
			<form action="" method="POST">
				<input type="hidden" name="order_id" value="<?php echo $fetch_orders["id"]; ?>">
				<select name="update_payment">
					<option value="" selected disabled><?php echo $fetch_orders["payment_status"]; ?></option>
					<option value="pending">pending</option>
					<option value="completed">completed</option>
				</select>
				<input type="submit" value="update" name="update_order" class="option-btn">
				<a href="admin_orders.php?delete=<?php echo $fetch_orders["id"];?>" onclick="return confirm('delete this order?')" class="delete-btn">delete</a>
			</form>
		</div>
		<?php 
			}
		}else{
			echo "<p class='empty'>no orders placed yet!</p> ";
		} 

		?>
	</div>
	
</section>


<script src="admin_script.js"></script>
</body>
</html>