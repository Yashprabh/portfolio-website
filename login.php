<?php
session_start();
include 'includes/db.php';

$selectedRole = 'user'; // default view role

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $selectedRole = $_POST['role']; // user/admin from form

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($user_id, $hashed_password, $role);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                if ($role === $selectedRole) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['role'] = $role;

                    if ($role === 'admin') {
                        header("Location: admin/dashboard.php");
                    } else {
                        header("Location: users.php");
                    }
                    exit();
                } else {
                    $error = "Access denied for selected role.";
                }
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No user found with that email.";
        }
    } else {
        $error = "SQL error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - DJ Management</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('assets/images/login.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .login-container {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.6);
            width: 350px;
            text-align: center;
        }

        .role-toggle {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .role-btn {
            flex: 1;
            padding: 10px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
            background-color: #333;
            color: #ccc;
            transition: 0.3s ease;
        }

        .role-btn.active {
            background-color: #1DB954;
            color: #fff;
        }

        input[type="email"],
        input[type="password"] {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            outline: none;
        }

        button[type="submit"] {
            padding: 12px 25px;
            background-color: #1DB954;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #14833b;
        }

        .error {
            color: #ff4c4c;
            margin-top: 10px;
        }

        .hidden {
            display: none;
        }

        ::placeholder {
            color: #999;
        }
    </style>

    <script>
        function setRole(role) {
            document.getElementById('role').value = role;
            document.getElementById('userBtn').classList.remove('active');
            document.getElementById('adminBtn').classList.remove('active');
            document.getElementById(role + 'Btn').classList.add('active');
        }
    </script>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <div class="role-toggle">
            <button type="button" id="userBtn" class="role-btn <?php echo $selectedRole === 'user' ? 'active' : ''; ?>" onclick="setRole('user')">User</button>
            <button type="button" id="adminBtn" class="role-btn <?php echo $selectedRole === 'admin' ? 'active' : ''; ?>" onclick="setRole('admin')">Admin</button>
        </div>

        <form method="POST">
            <input type="hidden" name="role" id="role" value="<?php echo $selectedRole; ?>">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>

        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </div>

    <script>
        // Default selected role on page load
        window.onload = function() {
            setRole('<?php echo $selectedRole; ?>');
        }
    </script>
</body>
</html>

