<?php 
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
	header("location:login.php");
}


if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM cart 
        WHERE name = '$product_name' AND user_id = '$user_id' ");

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart!';
    }else{
        mysqli_query($conn, "INSERT INTO cart(user_id, name, price, quantity, image) 
            VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image') ");
        $message[] = 'product added to cart!';
        
    }
}





 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>home</title>
 	<link rel="stylesheet" href="style.css">
 </head>
 <body>

<?php include 'header.php'; ?>


<section class="home">
    <div class="content">
        <h3>Hand Picked Book to your door</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.</p>
        <a href="about.php" class="white-btn">discover more</a>
        
    </div>
</section>


<section class="products">

    <h1 class="title">latest products</h1>

    <div class="box-container">
        <?php
        //limit para limitar el numero de productos a mostrar  
            $select_products = mysqli_query($conn, "SELECT * FROM products LIMIT 4") or die("query failed");

            if (mysqli_num_rows($select_products) > 0){
                while ($fetch_products = mysqli_fetch_assoc($select_products)){      
        ?>

        <form action="" method="POST" class="box">
            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="image">
            <div class="name"><?php echo $fetch_products['name']; ?></div>
            <div class="price">$ <?php echo $fetch_products['price']; ?></div>
            <input type="number" min="1" name="product_quantity" value="1" class="qty">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
        </form>

        <?php 
                } 

            }else{
                echo "<p class='empty'>no products added yet!</p>";
            } 

        ?>
    </div>

    <div class="load-more" style="margin-top: 3rem; text-align: center;">
        <a href="shop.php" class="option-btn">load more</a>
    </div>

</section>











<?php include 'footer.php'; ?>

<script src="script.js"></script>
</body>
</html>