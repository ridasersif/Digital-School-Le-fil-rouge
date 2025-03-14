function togglePassword(id) {
    var passwordInput = document.getElementById(id);
    var icon = document.getElementById('eye-icon-' + id);
    console.log(icon);
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}