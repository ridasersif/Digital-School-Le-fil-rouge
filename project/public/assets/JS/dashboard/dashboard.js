
const themeToggle = document.getElementById('theme-toggle');

function setTheme(theme) {
    document.body.setAttribute('data-bs-theme', theme);
    // document.div.setAttribute('data-bs-theme', theme);
    localStorage.setItem('theme', theme); 
}
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
    setTheme(savedTheme); 
}
themeToggle.addEventListener('click', () => {
    const currentTheme = document.body.getAttribute('data-bs-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    setTheme(newTheme)
})



document.addEventListener("DOMContentLoaded", function () {
    let categoryToggle = document.querySelector("[data-bs-target='#categorySubmenu']");
    let categoryMenu = document.querySelector("#categorySubmenu");
    let icon = categoryToggle.querySelector(".toggle-icon");
    categoryMenu.addEventListener("shown.bs.collapse", function () {
        icon.classList.add("fa-rotate-90"); 
    });
    categoryMenu.addEventListener("hidden.bs.collapse", function () {
        icon.classList.remove("fa-rotate-90"); 
    });
});
