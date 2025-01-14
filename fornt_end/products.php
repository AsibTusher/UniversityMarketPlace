<?php
require("../php_backend/connection.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit();
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Products</title>
    <link rel="stylesheet" href="./resource/style.css">
</head>
<body>
    <?php
    include("navbar.php");
    ?>

<h3>Product Categories</h3>

<?php
// Query to fetch category data
$sql = "SELECT * FROM category"; // Assuming 'product_categories' is the table name for categories

// Execute the query
$result = $conn->query($sql);

// Check if the query executed successfully
if ($result === false) {
    // Output any errors from the query
    echo "Error: " . $conn->error;
} elseif ($result->num_rows > 0) {
    // Start container for category cards
    echo "<div class='category-cards-container'>";

    // Fetch and display each category
    while ($row = mysqli_fetch_assoc($result)) {
        $category_id = $row["id"];
        $category_name = $row["category_name"];
       
        // Display category as a card
        echo "<div class='category-card'>
                
                <h4>$category_name</h4>
           
                <a href='view_category_products.php?category_id=$category_id'>View Products</a>
            </div>";
    }

    echo "</div>"; // Close the container
} else {
    echo "<p>No categories available.</p>";
}
?>


    
</body>
</html>
