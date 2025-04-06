const modeToggle = document.getElementById("mode-toggle");
const body = document.body;

modeToggle.addEventListener("click", () => {
    body.classList.toggle("dark-mode");
    body.classList.toggle("light-mode");
    modeToggle.textContent = body.classList.contains("dark-mode") ? "☀️" : "🌙";
});

// Set initial mode
if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    body.classList.add("dark-mode");
    modeToggle.textContent = "☀️";
} else {
    body.classList.add("light-mode");
    modeToggle.textContent = "🌙";
}
