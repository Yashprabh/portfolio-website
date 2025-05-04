<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $rating = $_POST["rating"] ?? null;

    $stmt = $conn->prepare("INSERT INTO feedback (name, email, message, rating, submitted_at) VALUES (?, ?, ?, ?, NOW())");
    if ($stmt) {
        $stmt->bind_param("sssi", $name, $email, $message, $rating);
        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = "Database error: " . $stmt->error;
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
    <title>Feedback</title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
        }

        .form-container {
            max-width: 500px;
            margin: auto;
            background: #1e1e1e;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.6);
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 20px;
            background: #2c2c2c;
            color: white;
            border: none;
            border-radius: 8px;
        }

        button {
            background: #1DB954;
            color: white;
            border: none;
            padding: 12px 20px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
        }

        .success {
            text-align: center;
            margin-top: 40px;
            color: #00e676;
        }

        .btn-home {
            display: inline-block;
            margin-top: 20px;
            background: #ff4081;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php if (isset($success)): ?>
    <div class="success">
        <h2>✅ Thank you for your feedback!</h2>
        <a class="btn-home" href="index.php">🏠 Back to Home</a>
    </div>
<?php else: ?>
    <div class="form-container">
        <h2>Feedback Form</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Feedback" rows="4" required></textarea>
            <select name="rating" required>
                <option value="">Rate Us</option>
                <option value="5">5 - Excellent</option>
                <option value="4">4 - Good</option>
                <option value="3">3 - Average</option>
                <option value="2">2 - Poor</option>
                <option value="1">1 - Terrible</option>
            </select>
            <button type="submit">Submit Feedback</button>
        </form>
        <?php if (isset($error)) echo "<p style='color: red;'>❌ $error</p>"; ?>
    </div>
<?php endif; ?>

</body>
</html>
