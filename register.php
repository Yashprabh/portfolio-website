<?php
session_start();
include "includes/db.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email is already registered.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = "user"; // Default role

            $insert = $conn->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)");
            $insert->bind_param("ssss", $full_name, $email, $hashed_password, $role);

            if ($insert->execute()) {
                $success = "Registration successful! You can now <a href='login.php' style='color:#00e676;'>Login</a>.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - DJ Booking</title>
    <style>
        body {
            background-color: #ffffff;
            background: url('assets/images/reg.jpg') no-repeat center center fixed;
            color: white;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background-color: #1e1e1e;
            padding: 40px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        }
        .register-container h2 {
            color: #ff4081;
            text-align: center;
            margin-bottom: 20px;
        }
        .register-container input[type="text"],
        .register-container input[type="email"],
        .register-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: none;
            background-color: #2a2a2a;
            color: white;
        }
        .register-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #ff4081;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        .message {
            text-align: center;
            margin-top: 15px;
        }
        .error {
            color: #ff1744;
        }
        .success {
            color: #00e676;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Create Account</h2>
        <?php if ($error): ?>
            <div class="message error"><?= $error ?></div>
        <?php elseif ($success): ?>
            <div class="message success"><?= $success ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
