<script>
let currentAudio = null;

document.querySelectorAll('.dj-hover').forEach(img => {
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

<?php
include("includes/header.php"); 
?>

<style>
    body, html {
        height: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        background-color: #121212;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .main-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Hero Section */
    .hero {
        background: url('assets/images/1.jpg') center/cover no-repeat;
        height: 70vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-shadow: 2px 2px 6px rgba(0,0,0,0.6);
        border-radius: 10px;
        margin-bottom: 20px;
        padding: 0 20px;
    }

    .hero h1 {
        font-size: 3em;
        margin-bottom: 10px;
    }

    .hero p {
        font-size: 1.3em;
        max-width: 600px;
        text-align: center;
    }

    /* DJ Cards */
    .dj-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin: 30px auto 0;
    max-width: 1000px;
    padding: 0 20px;
}

    .dj-card {
        background-color: #1e1e1e;
        border: 1px solid #333;
        border-radius: 12px;
        padding: 20px;
        width: 280px;
        color: #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.6);
        transition: transform 0.3s ease;
        overflow: hidden;
    }

    .dj-card:hover {
        transform: translateY(-5px);
        border-color: #ff4081;
    }

    .dj-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .dj-card h3 {
        margin-top: 0;
        color: #ff4081;
    }

    .dj-card p {
        font-size: 14px;
        color: #ccc;
    }

    .dj-card button {
        margin-top: 10px;
        padding: 10px 16px;
        border: none;
        background-color: #ff4081;
        color: #fff;
        font-weight: bold;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .dj-card button:hover {
        background-color: #e73370;
    }

    section {
        text-align: center;
    }

    /* Button at Bottom */
    .button-wrapper {
        text-align: center;
        margin-top: 30px;
        margin-bottom: 40px;
    }

    .button-wrapper button {
        padding: 12px 24px;
        background-color: #ff4081;
        color: #fff;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }

    .button-wrapper button:hover {
        background-color: #e73370;
    }
</style>

<div class="main-content">
    <div>
        <div class="hero">
            <h1>Unleash the Beats</h1>
            <p>Book the hottest DJs for your next event. Easy. Fast. Reliable.</p>
        </div>

        <section>
            <h2>🎧 Featured DJs</h2>
            <p>Choose from a wide range of talented DJs for weddings, parties, corporate events, and more.</p>
        </section>

        <div class="dj-list">
            <div class="dj-card">
                <img src="assets/images/dj1.jpg" alt="DJ Arjun" class="dj-hover" data-audio="assets/sounds/song1.mp3">
                <h3>DJ PANDA</h3>
                <p>📍 Bangalore</p>
                <p>Bollywood & EDM Specialist</p>
            </div>

            <div class="dj-card">
                <img src="assets/images/dj2.jpg" alt="DJ Neha" class="dj-hover" data-audio="assets/sounds/song2.mp3">
                <h3>DJ Shark</h3>
                <p>📍 Mumbai</p>
                <p>Techno and Club Vibes</p>
            </div>

            <div class="dj-card">
                <img src="assets/images/dj3.jpg" alt="DJ Rohit" class="dj-hover" data-audio="assets/sounds/song3.mp3">
                <h3>DJ SKULL</h3>
                <p>📍 Delhi</p>
                <p>Hip-hop, Punjabi & House</p>
            </div>

            <div class="dj-card">
                <img src="assets/images/dj4.jpg" alt="DJ Tasha" class="dj-hover" data-audio="assets/sounds/song4.mp3">
                <h3>DJ Rabbit</h3>
                <p>📍 Hyderabad</p>
                <p>Hip-hop, Punjabi & House</p>
            </div>

            <div class="dj-card">
                <img src="assets/images/dj5.jpg" alt="DJ Zara" class="dj-hover" data-audio="assets/sounds/song5.mp3">
                <h3>DJ Robinhood</h3>
                <p>📍 Chennai</p>
                <p>Pop, EDM & House</p>
            </div>

            <div class="dj-card">
                <img src="assets/images/dj6.jpg" alt="DJ Ryan" class="dj-hover" data-audio="assets/sounds/song6.mp3">
                <h3>DJ Monkey</h3>
                <p>📍 Jharkhand</p>
                <p>Deep House & Chill Beats</p>
            </div>
        </div>
    </div>

    <div class="button-wrapper">
        <a href="book-dj.php">
        <button >IN DETAIL</button>
        </a>
    </div>
</div>


<?php include 'includes/footer.php'; ?>