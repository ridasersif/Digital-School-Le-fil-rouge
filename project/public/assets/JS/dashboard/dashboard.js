
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


