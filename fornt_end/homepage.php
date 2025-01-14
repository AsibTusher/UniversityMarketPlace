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
$stmt = $conn->prepare("SELECT username, email, dob, contact, uni_name, uni_email, role FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

// Bind the results to variables
$stmt->bind_result($username, $email, $dob, $contact, $uni_name, $uni_email, $role);
$stmt->fetch();

// Save the fetched values into variables for further use
$user_data = [
    'username' => $username,
    'email' => $email,
    'dob' => $dob,
    'contact' => $contact,
    'uni_name' => $uni_name,
    'uni_email' => $uni_email,
    'role' => $role
];

$stmt->close();

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
    <title>Homepage - University Marketplace</title>
    <link rel="stylesheet" href="./resource/style.css">
</head>
<body>
    <!-- Navbar -->
    <?php
        include("navbar.php");
    ?>

    <!-- Main Content -->
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>Explore the marketplace and connect with your peers.</p>
    </div>
</body>
</html>
