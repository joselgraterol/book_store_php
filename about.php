<?php 
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
	header("location:login.php");
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>about</title>
 	<link rel="stylesheet" href="style.css">
 </head>
 <body>

<?php include 'header.php'; ?>



<section class="home">
    <div class="content">
        <h3>this is the about page</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.</p>
        <a href="about.php" class="white-btn">discover more</a>
        
    </div>
</section>


<?php include 'footer.php'; ?>

<script src="script.js"></script>
</body>
</html>