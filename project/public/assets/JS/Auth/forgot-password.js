
    window.onload = function() {
        // Afficher le modal si le lien a été envoyé
        if (document.getElementById('resetPasswordModal')) {
            var myModal = new bootstrap.Modal(document.getElementById('resetPasswordModal'), {
                keyboard: false
            });
            myModal.show();
        }
    };
