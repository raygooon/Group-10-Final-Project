<?php
// Database connection
$host = 'localhost';
$db = 'coffee_shop';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop</title>
    <style>
        .product {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            text-align: center;
            width: 200px;
            display: inline-block;
        }
        .product img {
            width: 100px;
            height: 100px;
        }
        .product a {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            text-decoration: none;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Coffee Shop Menu</h1>

    <div class="products">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                echo '<img src="' . $row['image_path'] . '" alt="' . $row['name'] . '">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<p>P' . number_format($row['price'], 2) . '</p>';
                echo '<a href="cartSection.html">Add to cart</a>';
                echo '</div>';
            }
        } else {
            echo '<p>No products available.</p>';
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
