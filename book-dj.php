<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include "includes/header.php"; ?>

<style>
body {
    background-color: #121212;
    color: #ffffff;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.booking-section {
    max-width: 1100px;
    margin: 60px auto;
    padding: 0 30px;
    text-align: center;
}

.booking-section h1 {
    color: #ff4081;
    margin-bottom: 10px;
    font-size: 36px;
}

.booking-section p {
    color: #bbb;
    font-size: 16px;
    margin-bottom: 30px;
}

.dj-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 25px;
}

.dj-card {
    background: #1e1e1e;
    border: 1px solid #2c2c2c;
    border-radius: 15px;
    padding: 25px;
    width: 280px;
    transition: transform 0.3s ease, border-color 0.3s ease;
    box-shadow: 0 6px 20px rgba(0,0,0,0.6);
}

.dj-card:hover {
    transform: translateY(-8px);
    border-color: #ff4081;
}

.dj-card h3 {
    color: #ff4081;
    margin: 0 0 10px;
}

.dj-card p {
    font-size: 14px;
    color: #ccc;
    margin: 5px 0;
}

.price {
    color: #00e676;
    font-weight: bold;
    font-size: 16px;
    margin-top: 8px;
}

.book-btn {
    background-color: #ff4081;
    border: none;
    padding: 10px 18px;
    color: white;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 15px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.book-btn:hover {
    background-color: #e73370;
}
</style>

<div class="booking-section">
    <h1>🎧 Book a DJ for Your Event</h1>
    <p>Select from top DJs and click "Book Now" to reserve!</p>
    


    <div class="dj-list">
        <?php
       include("includes/db.php");
       $djs = mysqli_query($conn, "SELECT * FROM djs");
       
       if (!$djs) {
           die("SQL Error: " . mysqli_error($conn));
       }
       
       while ($dj = mysqli_fetch_assoc($djs)) :
    
    
        ?>
            <div class="dj-card">
            <img src="assets/images/<?php echo $dj['image']; ?>" alt="<?php echo $dj['name']; ?>" style="width:100%; border-radius:10px; margin-bottom:15px;">
                <h3><?php echo $dj['name']; ?></h3>
                <p>📍 <?php echo $dj['city']; ?></p>
                <p><?php echo $dj['genre']; ?></p>
                <p class="price">₹<?php echo $dj['price']; ?></p>
                <form action="book.php" method="POST">
                    <input type="hidden" name="dj_id" value="<?php echo $dj['id']; ?>">
                    <button class="book-btn">Book Now</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="assets/js/script.js"></script>

<?php include("includes/footer.php"); ?>