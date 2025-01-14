<?php


// Retrieve user data from session
$user_data = $_SESSION['user_data']; // Assuming the user data is already set in the session after login
?>

<div class="header">
    <h1>Welcome to University Marketplace</h1>
    <nav class="navbar">
        <ul>
            <li><a href="homepage.php">Home</a></li>

            <?php if ($user_data['role'] === 'admin'): ?>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="view_reports.php">View Reports</a></li>
            <?php elseif ($user_data['role'] === 'seller'): ?>
                <li><a href="products.php">Products</a></li>
                <li><a href="sell.php">Sell</a></li>
                <li><a href="seller_dashboard.php">Seller Dashboard</a></li>
            <?php elseif ($user_data['role'] === 'buyer'): ?>
                <li><a href="products.php">Products</a></li>
                <li><a href="my_orders.php">My Orders</a></li>
            <?php endif; ?>

            <li><a href="profile.php">Profile</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="?logout=true">Logout</a></li>
        </ul>
    </nav>
</div>
