<?php 
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
	header("location:login.php");
}


if (isset($_POST['order_now_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = $_POST['number'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $placed_on = date('d-M-Y');
    $method = mysqli_real_escape_string($conn, $_POST['method']);

    $cart_total = 0;
    $cart_products[] = '';
    $cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' ") or die("query failed");

    if (mysqli_num_rows($cart_query) > 0){
        while ($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['name'] . ' (' .$cart_item['quantity'].')';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ',$cart_products); 

    $order_query = mysqli_query($conn, "SELECT * FROM orders WHERE name = '$name' AND number = '$number' AND
        email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total' ");

    if ($cart_total == 0) {
        $message[] = 'your cart is empty';
    }else{
        if (mysqli_num_rows($order_query) > 0) {
           $message[] = 'order already placed'; 
        }else{
            mysqli_query($conn, "INSERT INTO orders(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')");
            $message[] = 'order placed successfully!';
            mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id' "); 

        }
        

    }
}




?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>checkout</title>
 	<link rel="stylesheet" href="style.css">
 </head>
 <body>

<?php include 'header.php'; ?>


<section class="display-order">

    <?php  

        $gran_total_final = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' ") or die("query failed");
        if (mysqli_num_rows($select_cart) > 0){
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)){
                $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                $gran_total_final += $total_price;
    ?>

    <p><?php echo $fetch_cart['name']; ?> <span>(<?php echo '$' .$fetch_cart['price'] . ' x ' . $fetch_cart['quantity']; ?>)</span></p>

    <?php
            } 

        }else{
            echo "<p class='empty'>your cart is empty!</p>";
        } 

    ?>

    <div class="grand-total"> grand total : <span>$<?php echo $gran_total_final; ?></span></div>
    
</section>

<section class="checkout">
    <form action="" method="POST">
        <h3>place your order</h3>
        <div class="flex">
            <div class="inputBox">
                <span>your name :</span>
                <input type="text" name="name" required placeholder="enter your name">
            </div>

            <div class="inputBox">
                <span>your number :</span>
                <input type="number" name="number" required placeholder="enter your number">
            </div>

            <div class="inputBox">
                <span>your email :</span>
                <input type="email" name="email" required placeholder="enter your email">
            </div>

            <div class="inputBox">
                <span>payment method :</span>
                <select name="method">
                    <option value="cash on delivery">cash on delivery</option>
                    <option value="credit card">credit card</option>
                    <option value="paypal">paypal</option>
                    <option value="zelle">zelle</option>
                </select>
            </div>

            <div class="inputBox">
                <span>your address :</span>
                <input type="text" name="address" required placeholder="enter your address">
            </div>
        </div>

        <input type="submit" name="order_now_btn" value="order now" class="btn">
    </form>
</section>



<?php include 'footer.php'; ?>

<script src="script.js"></script>
</body>
</html>