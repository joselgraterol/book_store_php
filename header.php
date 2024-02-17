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
	
	<div class="header-1">

		<div class="flex">
			<div class="share">
				<a href="#">face</a>
				<a href="#">twitter</a>
				<a href="#">instagram</a>
				<a href="#">linkein</a>
			</div>
			<p> new <a href="login.php">login</a> | <a href="register.php">regiter</a></p>
		</div>

	</div>

	<div class="header-2">
		<div class="flex">
			<a href="home.php" class="logo">Bookly.</a>

			<nav class="navbar">
				<a href="home.php">home</a>
				<a href="about.php">about</a>
				<a href="shop.php">shop</a>
				<a href="contact.php">contact</a>
				<a href="orders.php">orders</a>
			</nav>

			<div class="icons">
				<div id="menu-btn">menu</div>
				<a href="search_page.php">search</a>
				<div id="user-btn">user</div>
				<?php 

					$select_cart_number = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' ");
					$cart_rows_number = mysqli_num_rows($select_cart_number);

				?>
				<a href="cart.php">cart (<?php echo $cart_rows_number; ?>)</a>
			</div>

			<div class="user-box">
				<p>username : <span> <?php echo $_SESSION['user_name']; ?></span></p>
				<p>email : <span> <?php echo $_SESSION['user_email']; ?></span></p>
				<a href="logout.php" class="delete-btn">logout</a>
			</div>
		</div>

		
		

	</div>

</header>