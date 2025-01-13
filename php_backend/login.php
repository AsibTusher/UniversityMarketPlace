<?php
require("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            header("Location: ../fornt_end/homepage.php");
            exit();
        } else {
            $error = "Invalid username or password.";
            header("Location: ../fornt_end/login_page.php?error=" . urlencode($error));
            exit();
        }
    } else {
        $error = "Invalid username or password.";
        header("Location: ../fornt_end/login_page.php?error=" . urlencode($error));
        exit();
    }

    $stmt->close();
}
?>