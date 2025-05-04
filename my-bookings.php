<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("includes/db.php");
include("includes/header.php");

$user_id = $_SESSION['user_id'];
?>

<style>
body {
    background-color: #121212;
    color: #ffffff;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.booking-history {
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 20px;
}

.booking-history h1 {
    text-align: center;
    color: #ff4081;
    margin-bottom: 30px;
}

.booking-card {
    background: #1e1e1e;
    border: 1px solid #2c2c2c;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.4);
}

.booking-card h3 {
    color: #ff4081;
    margin-bottom: 10px;
}

.booking-card p {
    margin: 4px 0;
    font-size: 14px;
    color: #ccc;
}

.status {
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: bold;
    display: inline-block;
    margin-top: 8px;
}

.status.pending {
    background-color: #ffa726;
    color: #000;
}

.status.approved {
    background-color: #66bb6a;
    color: #fff;
}

.status.rejected {
    background-color: #ef5350;
    color: #fff;
}
</style>

<div class="booking-history">
    <h1>📋 My DJ Bookings</h1>

    <?php
    $query = "
    SELECT b.*, d.name AS dj_name, d.city, d.genre, d.price 
    FROM bookings b 
    JOIN djs d ON b.dj_id = d.id 
    WHERE b.user_id = ?
    ORDER BY b.booking_date DESC
";

$stmt = $conn->prepare($query);

if (!$stmt) {
    die("❌ Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0):
    while ($booking = $result->fetch_assoc()):

    ?>
        <div class="booking-card">
            <h3><?php echo htmlspecialchars($booking['dj_name']); ?> (₹<?php echo $booking['price']; ?>)</h3>
            <p><strong>📍 City:</strong> <?php echo htmlspecialchars($booking['city']); ?></p>
            <p><strong>🎶 Genre:</strong> <?php echo htmlspecialchars($booking['genre']); ?></p>
            <p><strong>📅 Booked on:</strong> <?php echo date('d M Y, h:i A', strtotime($booking['booking_date'])); ?></p>
            <p><strong>Status:</strong>
                <span class="status <?php echo strtolower($booking['status']); ?>">
                    <?php echo ucfirst($booking['status']); ?>
                </span>
            </p>
        </div>
    <?php endwhile;
    else: ?>
        <p style="text-align: center; color: #ccc;">You have no bookings yet.</p>
    <?php endif;

    $stmt->close();
    ?>

</div>

<?php include("includes/footer.php"); ?>
