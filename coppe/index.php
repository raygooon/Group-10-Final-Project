<?php 
session_start();

include("database.php");

$user_id = $_SESSION['user_id'];

if(isset($_POST['add'])){

    $prodname = $_POST['prodname'];
    $prodprice = $_POST['prodprice'];
    $prodimage = $_POST['prodimage'];
    $prodquantity = $_POST['prodquantity'];
 
    $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$prodname' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($select_cart) > 0){
        $message[] = "Already added";
    } else{
        mysqli_query($con, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$prodname', '$prodprice', '$prodimage', '$prodquantity')") or die('query failed');
        $message[] = 'Added to cart';
     }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
<?php
       if(isset($message)){
        foreach($message as $message){
           echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
        }
     }

     
     ?>
<nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="account.php">Account</a></li>
      <li><a href="orders.php">Orders</a></li>
      <li><a href="cart.php">Cart</a></li>
    </ul>
  </nav>
 
  <?php
            $select_product = mysqli_query($con, "SELECT * FROM products where id = 1;") or die('query failed');
            if(mysqli_num_rows($select_product) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_product)){
            ?>

<div class="espresso">
    <h3></h3>
    <form method="post">
<img src="images/<?php echo $fetch_product['image']; ?>"  width="100" height="100"/>
<br><br>
<span><?php echo $fetch_product['name']; ?></span><br><br>
<span>₱<?php echo $fetch_product['price']; ?></span><br><br>

<input type="number" name="prodquantity" value="1">
 <input type="hidden" name="prodimage" value="<?php echo $fetch_product['image']; ?>">
 <input type="hidden" name="prodname" value="<?php echo $fetch_product['name']; ?>">
 <input type="hidden" name="prodprice" value="<?php echo $fetch_product['price']; ?>">
<br><br>
<button  name="add" class="Add-to-cart">Add to cart</button>
</form>
<br><br><br><br><br>

<?php 
            };
        };
            ?>


<?php
            $select_product = mysqli_query($con, "SELECT * FROM products where id = 2;") or die('query failed');
            if(mysqli_num_rows($select_product) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_product)){
            ?>

<div class="DarkChoco">
<h3></h3>
<form method="post">
<img src="images/<?php echo $fetch_product['image']; ?>" width="100" height="100"/>
<br><br>
<span><?php echo $fetch_product['name']; ?></span><br><br>
<span>₱<?php echo $fetch_product['price']; ?></span><br><br>

<input type="number" name="prodquantity" value="1">
 <input type="hidden" name="prodimage" value="<?php echo $fetch_product['image']; ?>">
 <input type="hidden" name="prodname" value="<?php echo $fetch_product['name']; ?>">
 <input type="hidden" name="prodprice" value="<?php echo $fetch_product['price']; ?>">
 <br><br>
<button name="add" class="Add-to-cart">Add to cart</button>
</form>
   <?php 
            };
        };
            ?>

<?php
            $select_product = mysqli_query($con, "SELECT * FROM products where id = 3;") or die('query failed');
            if(mysqli_num_rows($select_product) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_product)){
            ?>
</div>
<br><br><br><br>
 <div class="hot">
    <h4></h4>
    <form method="post">
    <img src="images/<?php echo $fetch_product['image']; ?>" width="100" height="100"/>
<br><br>
<span><?php echo $fetch_product['name']; ?></span><br><br>
<span>₱<?php echo $fetch_product['price']; ?></span><br><br>

<input type="number" name="prodquantity" value="1">
 <input type="hidden" name="prodimage" value="<?php echo $fetch_product['image']; ?>">
 <input type="hidden" name="prodname" value="<?php echo $fetch_product['name']; ?>">
 <input type="hidden" name="prodprice" value="<?php echo $fetch_product['price']; ?>">
 <br><br>
<button name="add"class="Add-to-cart">Add to cart</button>
                </form>
    <?php 
            };
        };
            ?>


<?php
            $select_product = mysqli_query($con, "SELECT * FROM products where id = 4;") or die('query failed');
            if(mysqli_num_rows($select_product) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_product)){
            ?>
<div class="latte">
<h5></h5>
<form method="post">
<img src="images/<?php echo $fetch_product['image']; ?>" width="100" height="100"/>
<br><br>
<span><?php echo $fetch_product['name']; ?></span><br><br>
<span>₱<?php echo $fetch_product['price']; ?></span><br><br>

<input type="number" name="prodquantity" value="1">
 <input type="hidden" name="prodimage" value="<?php echo $fetch_product['image']; ?>">
 <input type="hidden" name="prodname" value="<?php echo $fetch_product['name']; ?>">
 <input type="hidden" name="prodprice" value="<?php echo $fetch_product['price']; ?>">
 <br><br>
<button  name="add"class="Add-to-cart">Add to cart</button>
                </form>
<?php 
            };
        };
            ?>
<?php
            $select_product = mysqli_query($con, "SELECT * FROM products where id = 5;") or die('query failed');
            if(mysqli_num_rows($select_product) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_product)){
            ?>
<div class="macchiato">
    <h6></h6>
    <form method="post">
    <img src="images/<?php echo $fetch_product['image']; ?>" width="100" height="100"/>
<br><br>
<span><?php echo $fetch_product['name']; ?></span><br><br>
<span>₱<?php echo $fetch_product['price']; ?></span><br><br>

<input type="number" name="prodquantity" value="1">
 <input type="hidden" name="prodimage" value="<?php echo $fetch_product['image']; ?>">
 <input type="hidden" name="prodname" value="<?php echo $fetch_product['name']; ?>">
 <input type="hidden" name="prodprice" value="<?php echo $fetch_product['price']; ?>">
 <br><br>
<button name="add" class="Add-to-cart">Add to cart</button>
                </form>
 <?php 
            };
        };
            ?>
</body>
<style>
    nav {
    background-color: #333;
    overflow: hidden;
    margin-bottom: 5rem;
  }
  
  nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
  }
  
  nav li {
    float: left;
  }
  
  nav li a {
    display: block;
    color: white;
  
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }
  
  nav li a:hover {
    background-color: #111;
  
  }
</style>