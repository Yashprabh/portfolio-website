<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("includes/header.php");
?>

<style>
@keyframes fadeInUp {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

body {
    background: linear-gradient(to right, #1e1e1e, #121212);
    color: #fff;
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1100px;
    margin: 80px auto;
    padding: 30px;
    text-align: center;
    animation: fadeInUp 1s ease-out;
}

.container h1 {
    font-size: 42px;
    color: #ff4081;
    margin-bottom: 10px;
    text-shadow: 0 0 10px #ff4081;
    animation: fadeInUp 1.2s ease-out;
}

.container p {
    font-size: 18px;
    color: #ccc;
    margin-bottom: 40px;
    animation: fadeInUp 1.4s ease-out;
}

.buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    animation: fadeInUp 1.6s ease-out;
}

.buttons a {
    padding: 15px 30px;
    background: linear-gradient(to right, #1DB954, #1ed760);
    color: #fff;
    border-radius: 12px;
    font-weight: bold;
    text-decoration: none;
    font-size: 16px;
    box-shadow: 0 0 10px #1DB954;
    transition: all 0.3s ease;
}

.buttons a:hover {
    background: #14833b;
    transform: scale(1.05);
    box-shadow: 0 0 20px #1DB954;
}

.images {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin-top: 50px;
    animation: fadeInUp 1.8s ease-out;
}

.images img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
}

.images img:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
}
</style>

<div class="container">
    <h1>👋 Welcome, DJ Enthusiast!</h1>
    <p>You're logged in successfully. What would you like to do today?</p>

    <div class="buttons">
        <a href="book-dj.php">🎧 Book a DJ</a>
        <a href="my-bookings.php">📋 My Bookings</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

    <div class="images">
    <img src="assets/images/dj1.jpg" alt="DJ 1" class="dj-image" data-audio="assets/sounds/song1.mp3">
    <img src="assets/images/dj2.jpg" alt="DJ 2" class="dj-image" data-audio="assets/sounds/song2.mp3">
    <img src="assets/images/dj3.jpg" alt="DJ 3" class="dj-image" data-audio="assets/sounds/song3.mp3">
    
</div>

</div>

<!-- Add your audio file here -->
<script>
let currentAudio = null;

document.querySelectorAll('.dj-image').forEach(img => {
    img.addEventListener('mouseenter', () => {
        const audioSrc = img.getAttribute('data-audio');
        if (currentAudio) {
            currentAudio.pause();
            currentAudio.currentTime = 0;
        }
        currentAudio = new Audio(audioSrc);
        currentAudio.play();
    });

    img.addEventListener('mouseleave', () => {
        if (currentAudio) {
            currentAudio.pause();
            currentAudio.currentTime = 0;
        }
    });
});
</script>


<?php include("includes/footer.php"); ?>
