<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $uni_name = "None";
    $uni_email = "None";
    $role = "buyer";

    // Validate input
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
        header("Location: ../fornt_end/registration_page.php?error=" . urlencode($error));
        exit();
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the query
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, dob, contact, uni_name, uni_email, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            $error = "Failed to prepare the SQL statement.";
            header("Location: ../fornt_end/registration_page.php?error=" . urlencode($error));
            exit();
        }

        $stmt->bind_param("ssssssss", $username, $email, $hashed_password, $dob, $contact, $uni_name, $uni_email, $role);

        if ($stmt->execute()) {
            header("Location: ../fornt_end/login_page.php");
            exit();
        } else {
            $error = "Failed to register. Please try again.";
            header("Location: ../fornt_end/registration_page.php?error=" . urlencode($error));
            exit();
        }

        $stmt->close();
    }
}
?>