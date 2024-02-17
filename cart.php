<?php 
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
	header("location:login.php");
}


if (isset($_POST['update_cart'])) {
    
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];

    mysqli_query($conn, "UPDATE cart SET quantity = '$cart_quantity' WHERE id = '$cart_id' ");

    $message[] = 'cart quantity updated!';

}


if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM cart WHERE id = '$delete_id' ");
    header("location:cart.php");
}

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id' ");
    header("location:cart.php");
}



?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>cart</title>
 	<link rel="stylesheet" href="style.css">
 </head>
 <body>

<?php include 'header.php'; ?>


<div>
    <h1 class="title">shopping cart</h1>
</div>


<section class="shopping-cart">
    <h1 class="title">products added</h1>

    <div class="box-container">
       <?php
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' ") or die("query failed");

            if (mysqli_num_rows($select_cart) > 0){
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)){      
        ?>

        <div class="box">
            <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="delete-x" onclick="return confirm('delete this product?')">X</a>
            <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" class="image"> 
            <div class="name"><?php echo $fetch_cart['name']; ?></div> 
            <div class="price">$<?php echo $fetch_cart['price']; ?></div> 
            <form method="POST" action="">
                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                <input type="submit" name="update_cart" value="update" class="option-btn">
            </form>

            <div class="sub-total"> sub total : <span>$ <?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']) ?></span></div>
        </div>

        <?php
            $grand_total +=  $sub_total;
                } 

            }else{
                echo "<p class='empty'>your cart is empty!</p>";
            } 

        ?> 
    </div>

    <div style="margin-top: 2rem; text-align: center;">
        <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)? '': 'disabled'; ?>" onclick="return confirm('delete all the products?')">delete all</a>
    </div>

    <div class="cart-total">
        <p>grand total : <span>$<?php echo $grand_total; ?></span></p>
        <div class="flex">
            <a href="shop.php" class="option-btn">continue shopping</a>
            <a href="checkout.php" class="btn <?php echo ($grand_total > 1)? '': 'disabled'; ?>">proceed to checkout</a>
        </div>
    </div>


</section>


<?php include 'footer.php'; ?>

<script src="script.js"></script>
</body>
</html>