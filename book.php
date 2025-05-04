<?php
session_start();
include("includes/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dj_id'])) {
    $dj_id = mysqli_real_escape_string($conn, $_POST['dj_id']);
    $user_id = $_SESSION['user_id'] ?? null;

    if ($user_id) {
        $query = "INSERT INTO bookings (user_id, dj_id, booking_date, status) VALUES ('$user_id', '$dj_id', NOW(), 'pending')";
        if (mysqli_query($conn, $query)) {
            $success = true;
        } else {
            $error = "Database Error: " . mysqli_error($conn);
        }
    } else {
        $error = "⚠️ You must be logged in to book a DJ.";
    }
} else {
    $error = "Invalid booking request.";
}
?>

<?php include("includes/header.php"); ?>

<style>
body {
    background-color: #121212;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    color: white;
}

.feedback-container {
    max-width: 600px;
    margin: 100px auto;
    padding: 30px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 0 15px rgba(255, 64, 129, 0.4);
    background-color: #1e1e1e;
    border: 2px solid;
}

.success {
    border-color: #00e676;
    color: #00e676;
}

.error {
    border-color: #ff1744;
    color: #ff1744;
}

a.back-link {
    display: inline-block;
    margin-top: 25px;
    padding: 10px 18px;
    background-color: #ff4081;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    transition: background 0.3s ease;
}
a.back-link:hover {
    background-color: #e73370;
}
</style>

<div class="feedback-container <?php echo isset($success) ? 'success' : 'error'; ?>">
    <?php
    if (isset($success)) {
        echo "🎉 DJ has been successfully booked!";
    } else {
        echo "❌ " . htmlspecialchars($error);
    }
    ?>
    <br>
    <a class="back-link" href="book-dj.php">← Back to DJ List</a>
</div>

<?php include("includes/footer.php"); ?>
