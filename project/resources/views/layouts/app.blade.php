<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Authentification') | {{ config('app.name', 'E-Learning') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">




    @stack('styles')
</head>
<body>
    @yield('content')
   <!-- Bootstrap JS and dependencies -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- Chart.js -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- Inclure Iconify dans votre projet -->
   <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
   
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
   @stack('scripts')
   <script>
     setTimeout(() => {
    let alert = document.querySelector('.alert-success');
    if (alert) {
        alert.style.transition = "opacity 0.5s";
        alert.style.opacity = "0";
        setTimeout(() => alert.remove(), 500);
    }
}, 3000);

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function() {
            let input = this.previousElementSibling;
            if (input.type === "password") {
                input.type = "text";
                this.classList.remove("bi-eye");
                this.classList.add("bi-eye-slash");
            } else {
                input.type = "password";
                this.classList.remove("bi-eye-slash");
                this.classList.add("bi-eye");
            }
        });
    });

    // Function for handling form submission and showing the spinner
    function handleFormSubmit(formSelector) {
        document.querySelector(formSelector).addEventListener("submit", function(event) {
            let button = this.querySelector("button[type='submit']");
            let spinner = button.querySelector(".spinner-border");

            if (spinner) {
                spinner.classList.remove("d-none");
                spinner.classList.add("d-inline-block");
            }
            button.disabled = true;
        });
    }

    // Handling email modal form submit
    handleFormSubmit("form[action='{{ route('update.email') }}']");

    // Handling password change form submit
    handleFormSubmit("form[action='{{ route('update.password') }}']");
});


 

   </script>
</body>
</html>