<div id="loading-indicator" class="mt-3 text-center" style="display: none;">
    <div class="d-flex justify-content-center align-items-center">
        <div class="spinner-border text-success me-2" role="status">
            <span class="visually-hidden">Chargement...</span>
        </div>
        <span class="text-success">Envoi en cours... Veuillez patienter pendant le téléchargement des fichiers.</span>
    </div>
    <div class="progress mt-2">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%"></div>
    </div>
    <script>
        // Ajouter l'indicateur de chargement lors de la soumission du formulaire
        document.querySelector('.loadingForm').addEventListener('submit', function() {
            // Afficher l'indicateur de chargement
            document.getElementById('loading-indicator').style.display = 'block';
            
            // Animation de la barre de progression pour simuler le chargement
            let width = 0;
            const progressBar = document.querySelector('.progress-bar');
            
            const interval = setInterval(function() {
                if (width >= 95) {
                    clearInterval(interval);
                } else {
                    width += Math.random() * 5;
                    if (width > 95) width = 95; // Ne jamais atteindre 100% avant que le serveur réponde
                    progressBar.style.width = width + '%';
                }
            }, 500);
        });
    </script>
</div>