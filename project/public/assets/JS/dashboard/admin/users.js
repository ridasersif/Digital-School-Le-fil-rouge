
    $(document).ready(function() {
        // Initialisation de DataTables
        const usersTable = $('#usersTable').DataTable({
            responsive: true,
            pageLength: 4,
            lengthMenu: [4,6, 10, 25, 50, 100,1000],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json",
                search: "_INPUT_",
                searchPlaceholder: "Rechercher un utilisateur...",
                lengthMenu: "Afficher _MENU_ éléments",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                paginate: {
                    first: "Premier",
                    last: "Dernier",
                    next: "Suivant",
                    previous: "Précédent"
                }
            },
            initComplete: function() {
                $('.dataTables_filter input').attr('placeholder', 'Rechercher un utilisateur...');
            }
        });
        
        // Fonction pour créer et afficher une notification
        function showNotification(message, type = 'success') {
            // Supprimer les notifications existantes
            $('.notification-alert').remove();
            
            // Créer l'alerte
            const alertClass = `alert-${type}`;
            const alertIcon = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
            
            const alert = `
                <div class="alert ${alertClass} alert-dismissible fade show notification-alert">
                    <i class="${alertIcon} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            
            // Ajouter l'alerte au DOM
            $('body').append(alert);
            
            // Supprimer automatiquement après 4 secondes
            setTimeout(() => {
                $('.notification-alert').fadeOut(300, function() {
                    $(this).remove();
                });
            }, 5000);
        }
        
        // Gestion de la suppression d'utilisateur
        $(document).on('click', '.delete-user', function() {
            const userId = $(this).data('id');
            const userName = $(this).data('name');
            
            $('#userNameToDelete').text(userName);
            $('#confirmDeleteBtn').data('id', userId);
            $('#confirmDeleteBtn').data('name', userName);
            
            $('#confirmDeleteModal').modal('show');
        });
        
        // Confirmer la suppression
        $('#confirmDeleteBtn').on('click', function() {
            const userId = $(this).data('id');
            const userName = $(this).data('name');
            
            if (userId) {
                $.ajax({
                    url: `/admin/users/delete/${userId}`,
                    type: "DELETE",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                      },
                    success: function(response) {
                        $('#confirmDeleteModal').modal('hide');
                        
                        // Trouver et supprimer la ligne du tableau
                        usersTable.row($(`button.delete-user[data-id="${userId}"]`).closest('tr')).remove().draw();
                        
                        // Afficher la notification
                        showNotification(`L'utilisateur <strong>${userName}</strong> a été supprimé avec succès`, 'success');
                    },
                    error: function(xhr) {
                        showNotification("Une erreur est survenue lors de la suppression", 'danger');
                    }
                });
            }
        });
        
        // Gestion du changement de statut
        let userIdToToggle = null;
        let toggleButtonElement = null;
        
        $(document).on('click', '.toggle-status-btn', function() {
            userIdToToggle = $(this).data('id');
            toggleButtonElement = this;
            
            const userName = $(this).data('name');
            const currentStatus = $(this).data('status');
            const newStatus = currentStatus === 'active' ? 'inactif' : 'actif';
            
            $('#statusModalMessage').html(`Voulez-vous vraiment changer le statut de <strong>${userName}</strong> à <strong>${newStatus}</strong> ?`);
            
            $('#statusConfirmModal').modal('show');
        });
        
        // Confirmer le changement de statut
        $('#confirmStatusChangeBtn').on('click', function() {
            if (userIdToToggle && toggleButtonElement) {
                $.ajax({
                    url: $(toggleButtonElement).data('url'),
                    type: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                      },                 
                    data: JSON.stringify({ id: userIdToToggle }),
                    success: function(data) {
                        if (data.success) {
                            // Mise à jour du bouton
                            $(toggleButtonElement).text(data.label);
                            $(toggleButtonElement).removeClass('bg-success bg-danger');
                            $(toggleButtonElement).addClass(`bg-${data.badge_class}`);
                            $(toggleButtonElement).data('status', data.new_status);
                            
                            // Fermer le modal
                            $('#statusConfirmModal').modal('hide');
                            
                            // Afficher la notification
                            showNotification(`Le statut de l'utilisateur <strong>${$(toggleButtonElement).data('name')}</strong> a été modifié avec succès`, 'success');
                        }
                    },
                    error: function(xhr) {
                        showNotification("Une erreur est survenue lors du changement de statut", 'danger');
                    }
                });
                
            }
        });
    });
