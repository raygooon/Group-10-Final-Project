<?php
    include("database.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        session_start();

        setCookie('cook', $_POST['email'], time() + 1000 );

        $email = $_POST['email'];
        $password = $_POST['pass'];
    
        if (!empty($email) && !empty($password)) {
            $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
            $result = mysqli_query($con, $query);
    
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
    
                    if ($user_data['pass'] == $password) {
                        $_SESSION['id'] = $user_data['ID']; 
                        $_SESSION['user_id'] = $user_data['ID'];
                        $_SESSION['name'] = $user_data['name']; // Assuming 'fname' is the field for first name
                        $_SESSION['address'] = $user_data['address']; // Assuming 'email' is the field for email
                        $_SESSION['contactnumber'] = $user_data['cnum']; 
                        $_SESSION['email'] = $user_data['email']; 
                        $_SESSION['password'] = $user_data['pass']; 
                        header("location: index.php");
                        die;
                    }
                }
            }
            echo "<script type='text/javascript'> alert('wrong username or password') </script>";
        } else {
            echo "<script type='text/javascript'> alert('wrong username or password') </script>";
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
    <body background="hot.webp"></body>
</body>
<div class="main">
<div class="navbar">
    <div class="icon">
    <h1 class="logo">Coffee</h1>
    
    <p>coffee is the best part of waking up</p>
</div>

<div class="form">
<form method="POST"> 
    <h2>Login here</h2>
    <br><br>
    <label for="name">Email:</label>
    <input type="text" name="email" placeholder="Enter your email" required>
    <br><br>
    <label for="password">Password:</label>
    <input type="password" name="pass" placeholder="Enter your password" required>
   <br><br>
    <button class="Sign-in-button">Login</button>
    </form>
</div>

