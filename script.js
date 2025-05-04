// Toggle sidebar
const toggleBtn = document.querySelector("#toggleSidebar");
const sidebar = document.querySelector(".sidebar");

if (toggleBtn && sidebar) {
    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
    });
}

// Highlight active link
const links = document.querySelectorAll(".sidebar a");
const currentPath = window.location.pathname;

links.forEach(link => {
    if (link.href.includes(currentPath.split("/").pop())) {
        link.classList.add("active");
    }
});
