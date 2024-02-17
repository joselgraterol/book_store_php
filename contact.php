<?php 
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
	header("location:login.php");
}

if (isset($_POST['send_message'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM message 
        WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg' ");

    if (mysqli_num_rows($select_message) == 1) {
        $message[] = 'message sent already!';
    }else{
        mysqli_query($conn, "INSERT INTO message(user_id, name, email, number, message) 
            VALUES('$user_id', '$name', '$email', '$number', '$msg') ");
        $message[] = 'message sent successfully!';
    }
}





?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>contact</title>
 	<link rel="stylesheet" href="style.css">
 </head>
 <body>

<?php include 'header.php'; ?>

<section class="contact">
    <h1 class="title">contact us</h1>

    <form action="" method="POST">
        <input type="text" name="name" required placeholder="enter your name" class="box">
        <input type="email" name="email" required placeholder="enter your email" class="box">
        <input type="number" name="number" required placeholder="enter your number" class="box">
        <textarea name="message" class="box" placeholder="enter your message" cols="30" rows="10" required></textarea>
        <input type="submit" name="send_message" value="send message" class="btn">
    </form>
</section>


<?php include 'footer.php'; ?>

<script src="script.js"></script>
</body>
</html>