<?php
require("../php_backend/connection.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit();
}

// Fetch category ID from the URL parameter (e.g., category_id=1)
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;

// Fetch category and product data from the database based on the category_id
$sql = "SELECT * FROM product WHERE p_category_id = ?";
$stmt = $conn->prepare($sql);

// Check if the prepare statement failed
if ($stmt === false) {
    die('MySQL prepare error: ' . $conn->error);
}

$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the query executed successfully
if ($result === false) {
    echo "Error: " . $conn->error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category and Product List</title>
    <link rel="stylesheet" href="./resource/style.css"> <!-- Ensure this path is correct -->
</head>
<body>
    <?php include("navbar.php"); ?>

    <h3>Product List</h3>

    <div class="category-container">
        <?php
        if ($result->num_rows > 0) {
            // Display products
            while ($row = $result->fetch_assoc()) {
                // Display product details
                echo "<div class='product-card'>
                        <h5>" . htmlspecialchars($row['product_name']) . "</h5>
                        <p>Price: $" . htmlspecialchars($row['product_price']) . "</p>
                        <p>Description: " . htmlspecialchars($row['product_description']) . "</p>
                    </div>";
            }
        } else {
            echo "<p>No products available in this category.</p>";
        }
        ?>
    </div>
</body>
</html>
