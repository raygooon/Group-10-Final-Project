<?php 

session_start();

include("database.php");
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};


$name = isset($_SESSION['name']) ? $_SESSION['name'] : ""; 
$address = isset($_SESSION['address']) ? $_SESSION['address'] : ""; 
$contactnum = isset($_SESSION['contactnumber']) ? $_SESSION['contactnumber'] : ""; 
$email = isset($_SESSION['email']) ? $_SESSION['email'] : ""; 
$password = isset($_SESSION['password']) ? $_SESSION['password'] : ""; 


?>

<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="styles.css">
  <title>Account Table</title>
  
</head>

<body>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="account.php">Account</a></li>
      <li><a href="orders.php">Orders</a></li>
      <li><a href="cart.php">Cart</a></li>
      <li><a href="login.php" name="logout" class="logout-link" style="margin-left: 50rem; color: red;" onclick="return confirmLogout()">Log out</a></li>

<script>
    function confirmLogout() {
        return confirm("Are you sure you want to logout?");
    }
</script>
    </ul>
  </nav>
  <br><br><br>

  <h2>Account Information</h2>

  <table>
    <tr>
      <th>Username</th>
      <th>Address</th>
      <th>Contact number</th>
      <th>Email</th>
      <th>Password</th>
    </tr>
    <tr>
      <td><span><?php echo $name; ?></span></td>
      <td><span><?php echo $address; ?></span></td>
      <td><span><?php echo $contactnum; ?></span></td>
      <td><span><?php echo $email; ?></span></td>
      <td><span><?php echo $password; ?></span></td>
    </tr>
  
  </table>
</body>
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
</html>