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
$stmt->bind_result($username, $email, $dob, $contact, $uni_name, $uni_email, $role);
$stmt->fetch();
$stmt->close();

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ..\index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - University Marketplace</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 1em;
            text-align: center;
        }
        .container {
            padding: 2em;
        }
        .user-info {
            background-color: white;
            padding: 2em;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .user-info h2 {
            margin-top: 0;
        }
        .logout {
            text-align: right;
            margin-top: -2em;
        }
        .logout a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to University Marketplace</h1>
    </div>
    <div class="container">
        <div class="logout">
            <a href="?logout=true">Logout</a>
        </div>
        <div class="user-info">
            <h2>User Information</h2>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($dob); ?></p>
            <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($contact); ?></p>
            <p><strong>University Name:</strong> <?php echo htmlspecialchars($uni_name); ?></p>
            <p><strong>University Email:</strong> <?php echo htmlspecialchars($uni_email); ?></p>
            <p><strong>Role:</strong> <?php echo htmlspecialchars($role); ?></p>
        </div>
    </div>
</body>
</html>