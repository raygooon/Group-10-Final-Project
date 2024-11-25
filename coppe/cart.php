<?php 
session_start();

include("database.php");

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffee";

if (isset($_POST['buy'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assuming $user_id is obtained from a session or other secure method
    $userId = $_SESSION['user_id'];

    // Prepare the INSERT statement
    $stmt = $conn->prepare("INSERT INTO orders (user_id, name, price, image, quantity, date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssi", $userId, $name, $price, $image, $quantity, $date);

    // Fetch items from the cart for the current user
    $sql = "SELECT * FROM cart WHERE user_id = ?";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("i", $userId);
    $stmt2->execute();
    $result = $stmt2->get_result();

    // Insert each item into the buy table
    while ($row = $result->fetch_assoc()) {
        $userId = $row['user_id'];
        $name = $row['name'];
        $price = $row['price'];
        $image = $row['image'];
        $quantity = $row['quantity'];
        $date = date('Y-m-d'); // Get the current date

        $stmt->execute();
    }
    $date = date('Y-m-d');
    mysqli_query($con, "UPDATE `orders` SET date = '$date' WHERE user_id = '$user_id'") or die('query failed');
    // Redirect to index.php after successful insertion
    header('location:index.php');

    $stmt->close();
    $stmt2->close();
    $conn->close();
}

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($con, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
    header('location:cart.php');
 }

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

  <h2>Cart Section</h2>

  <table>
    <tr>
      <th>Image</th>
      <th>name</th>
      <th>price</th>
      <th>quantity</th>
      <th>total price</th>
      <th>remove</th>

    </tr>
    <?php
          $cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
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
      <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" name="remove" class="delete-btn" onclick="return confirm('remove item from cart?');">remove</a></td>
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
  <form method="post">
  <button name="buy" class="Add-to-cart">BUY</button>
  </form>
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