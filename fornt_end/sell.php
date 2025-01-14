<?php
require("../php_backend/connection.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit();
}

// Fetch user information
$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Image Upload Handling
    $image = $_FILES['image']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // Insert product into the database
        $stmt = $conn->prepare("INSERT INTO products (user_id, name, description, price, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issds", $user_id, $product_name, $description, $price, $target_file);

        if ($stmt->execute()) {
            $success_message = "Product listed successfully!";
        } else {
            $error_message = "Error listing the product. Please try again.";
        }

        $stmt->close();
    } else {
        $error_message = "Error uploading the image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell - University Marketplace</title>
    <link rel="stylesheet" href="./resource/style.css">
</head>
<body>
    <!-- Navbar -->
    <?php include("navbar.php"); ?>

    <!-- Main Content -->
    <div class="container">
        <h2>List a Product for Sale</h2>

        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form action="sell.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price ($):</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="image">Product Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="submit-button">List Product</button>
        </form>
    </div>
</body>
</html>
