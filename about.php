<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include("includes/header.php")?>

<style>
    body {
        background-color: #121212;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }

    .about-container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 30px;
        background-color: #1e1e1e;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
        animation: fadeIn 1s ease-in-out;
    }

    .about-container h1,
    .about-container h2 {
        color: #ff4081;
        margin-bottom: 20px;
        animation: slideUp 0.8s ease forwards;
        opacity: 0;
    }

    .about-container h1 {
        font-size: 2.5em;
        text-align: center;
        animation-delay: 0.2s;
    }

    .about-container h2 {
        font-size: 1.8em;
        margin-top: 30px;
    }

    .about-container p,
    .about-container li {
        font-size: 1.1em;
        line-height: 1.6;
        color: #ccc;
        animation: fadeIn 1s ease forwards;
        animation-delay: 0.4s;
        opacity: 0;
    }

    .about-container ul {
        list-style: none;
        padding-left: 0;
        margin-top: 10px;
    }

    .about-container li::before {
        content: "✔ ";
        color: #ff4081;
        margin-right: 8px;
    }

    .about-container li {
        margin-bottom: 8px;
        transition: color 0.3s ease;
    }

    .about-container li:hover {
        color: #ffffff;
        text-shadow: 0 0 5px #ff4081;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>

<div class="about-container">
    <h1>About Us</h1>
    <p>
        Welcome to <strong>DJ Management</strong> — your one-stop destination for booking professional DJs for any occasion! Whether you're planning a wedding, birthday party, corporate event, or just a fun weekend bash, we’ve got the perfect beat to match your vibe.
    </p>

    <h2>🎧 What We Do</h2>
    <p>
        Our platform connects you with top-rated DJs across genres. You can browse DJ profiles, check availability, and book them directly through our easy-to-use interface. Users can manage their bookings, view past events, and plan their entertainment effortlessly.
    </p>

    <h2>🔧 Features</h2>
    <ul>
        <li>Browse and book DJs based on your event date</li>
        <li>Secure user registration and login</li>
        <li>Admin panel for managing DJs and bookings</li>
        <li>Mobile-friendly and easy-to-navigate interface</li>
    </ul>

    <h2>🎉 Why Choose Us?</h2>
    <p>
        We believe music can transform any moment into a memory. With our network of skilled DJs, real-time booking system, and friendly user interface, we aim to bring life to every celebration.
    </p>

    <p>
        Thank you for choosing DJ Management. Let’s make your event unforgettable!
    </p>
</div>

<?php include 'includes/footer.php'; ?>