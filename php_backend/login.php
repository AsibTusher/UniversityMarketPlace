<?php
require("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query to fetch the user and role
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Store user id and role in the session
            $_SESSION['user_id'] = $id;
            $_SESSION['role'] = $role;

            // Fetch additional user data
            $stmt = $conn->prepare("SELECT username, email, dob, contact, uni_name, uni_email FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($username, $email, $dob, $contact, $uni_name, $uni_email);
            $stmt->fetch();
            $stmt->close();

            // Store additional user data in the session
            $_SESSION['user_data'] = [
                'username' => $username,
                'email' => $email,
                'dob' => $dob,
                'contact' => $contact,
                'uni_name' => $uni_name,
                'uni_email' => $uni_email,
                'role' => $role
            ];

            // Redirect based on the user's role
            if ($role == 'admin') {
                header("Location: ../fornt_end/admin_dashboard.php");
            } elseif ($role == 'buyer') {
                header("Location: ../fornt_end/homepage.php");
            } elseif ($role == 'seller') {
                header("Location: ../fornt_end/seller_homepage.php");
            } else {
                // Error handling for unexpected roles
                $error = "Role not recognized.";
                header("Location: ../fornt_end/login_page.php?error=" . urlencode($error));
            }
            exit();
        } else {
            // Invalid password
            $error = "Invalid username or password.";
            header("Location: ../fornt_end/login_page.php?error=" . urlencode($error));
            exit();
        }
    } else {
        // Username not found
        $error = "Invalid username or password.";
        header("Location: ../fornt_end/login_page.php?error=" . urlencode($error));
        exit();
    }

    $stmt->close();
}
?>
