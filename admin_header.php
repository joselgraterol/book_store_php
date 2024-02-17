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


<header class="header">
	
	<div class="flex">
		<a href="admin_page.php" class="logo">Admin <span>Panel</span></a>

		<nav class="navbar">
			<a href="admin_page.php">home</a>
			<a href="admin_products.php">products</a>
			<a href="admin_orders.php">orders</a>
			<a href="admin_users.php">users</a>
			<a href="admin_contacts.php">messages</a>
		</nav>

		<div class="icons">
			<div id="menu-btn">menu</div>
			<div id="user-btn">user</div>
		</div>

		<div class="account-box">
			<p>username : <span> <?php echo $_SESSION['admin_name']; ?></span></p>
			<p>email : <span> <?php echo $_SESSION['admin_email']; ?></span></p>
			<a href="logout.php" class="delete-btn">logout</a>
		</div>

	</div>

</header>