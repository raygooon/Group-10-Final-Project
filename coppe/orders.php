<?php 
session_start();

include("database.php");

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
    

<nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="account.php">Account</a></li>
      <li><a href="orders.php">Orders</a></li>
      <li><a href="cart.php">Cart</a></li>
    </ul>
  </nav>
  <br><br><br>

  <h2>Your Orders</h2>

  <table>
    <tr>
      <th>Image</th>
      <th>name</th>
      <th>price</th>
      <th>quantity</th>
      <th>total price</th>
      <th>date</th>

    </tr>
    <?php
          $cart_query = mysqli_query($con, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
          $grand_total = 0;
          if(mysqli_num_rows($cart_query) > 0){
             while($fetch_cart = mysqli_fetch_assoc($cart_query)){
       ?>
    <tr>
      <td><img src="images/<?php echo $fetch_cart['image'];?>" height="100" alt=""></td>
      <td><?php echo $fetch_cart['name']; ?></td>
      <td>₱<?php echo $fetch_cart['price']; ?>/-</td>
      <td><?php echo $fetch_cart['quantity']; ?></td>
      <td>₱<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
      <td><?php echo $fetch_cart['date']; ?></td>
         <?php
          $grand_total += $sub_total;
             }
          }else{
             echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6" id="myDiv">no item added</td></tr>';
          }
       ?>
 
    </tr>
    <tr>
    <td colspan="4">grand total :</td>
    <td>$<?php echo $grand_total; ?>/-</td>
  
    </tr>
  </table>
  <br><br>

</body>
<style>
    <style>
    
    body {
    background-color: beige;
    background: size 2%;
    padding: 25px;
}

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      text-align: left;
      padding: 8px;
      border-bottom: 1px solid #ddd;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    th {
      background-color: burlywood;
      color: white;
    }

    /* Navigation Bar Styles */
    nav {
      background-color: #333;
      overflow: hidden;
      margin-bottom: 20px; /* Adjust margin as needed */
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
</style>
</html>