//logique de alert 
    setTimeout(function() {
        document.getElementById('successAlert').style.display = 'none';
    }, 2000); 

    //logique de icon categories
    

    document.addEventListener('DOMContentLoaded', function () {
    // Fonction pour initialiser le sélecteur d'icônes pour un formulaire spécifique
    function initializeIconSelector(iconInputId, iconSuggestionsId, iconPreviewId, messageId) {
        const iconInput = document.getElementById(iconInputId);
        const iconSuggestions = document.getElementById(iconSuggestionsId);
        const iconPreview = document.getElementById(iconPreviewId);
        const messageElement = document.getElementById(messageId);

        if (!iconInput || !iconSuggestions || !iconPreview) return;

        // Variables pour ce formulaire
        let isLoading = false;
        let currentQuery = '';
        let popularIcons = [
            // Développement
            'mdi:code-tags', 'mdi:palette', 'mdi:cart', 'mdi:school', 'mdi:tree', 'mdi:robot', 'mdi:camera', 'mdi:console', 'mdi:git', 'mdi:monitor', 'mdi:laptop', 'mdi:code-braces', 'mdi:database', 'mdi:html5', 'mdi:javascript', 'mdi:python',
            // Design
            'mdi:brush', 'mdi:palette-swatch', 'mdi:picture', 'mdi:format-color-fill', 'mdi:artstation', 'mdi:draw', 'mdi:vector-pen', 'mdi:layers', 'mdi:scale',
            // Photographie
            'mdi:camera-enhance', 'mdi:video', 'mdi:filmstrip', 'mdi:gallery', 'mdi:image', 'mdi:flash', 'mdi:photo', 'mdi:slideshow', 'mdi:crop',
            // Intelligence Artificielle
            'mdi:brain', 'mdi:monitor-screenshot', 'mdi:cloud', 'mdi:cloud-upload', 'mdi:calculator', 'mdi:account-cog', 'mdi:settings-helper', 'mdi:database-search', 'mdi:comment-question',
            // Commerce et Entreprise
            'mdi:store', 'mdi:briefcase', 'mdi:currency-usd', 'mdi:bank', 'mdi:account-tie', 'mdi:shopping', 'mdi:warehouse', 'mdi:credit-card', 'mdi:clipboard-text',
            // Média Social
            'mdi:facebook', 'mdi:twitter', 'mdi:instagram', 'mdi:linkedin', 'mdi:whatsapp', 'mdi:snapchat', 'mdi:telegram', 'mdi:youtube', 'mdi:github', 'mdi:tiktok',
            // Santé et Médecine
            'mdi:stethoscope', 'mdi:hospital-building', 'mdi:pill', 'mdi:thermometer', 'mdi:medicine', 'mdi:doctor', 'mdi:hand-heart', 'mdi:ambulance', 'mdi:bandage', 'mdi:syringe',
            // Éducation
            'mdi:book', 'mdi:library', 'mdi:book-open', 'mdi:graduation-cap', 'mdi:pencil', 'mdi:chalkboard', 'mdi:teacher', 'mdi:student', 'mdi:lightbulb',
            // Voyage et Tourisme
            'mdi:airplane', 'mdi:car', 'mdi:train', 'mdi:hotel', 'mdi:map-marker', 'mdi:passport', 'mdi:mountain', 'mdi:earth', 'mdi:beach', 'mdi:cruise',
            // Alimentation
            'mdi:food', 'mdi:coffee', 'mdi:hamburger', 'mdi:pizza', 'mdi:fridge', 'mdi:beer', 'mdi:wine', 'mdi:cup', 'mdi:silverware', 'mdi:cheese',
            // Nature
            'mdi:sun', 'mdi:moon', 'mdi:water', 'mdi:flower', 'mdi:snowflake', 'mdi:mountain', 'mdi:cloud', 'mdi:leaf', 'mdi:seed'
        ];

        // Afficher un message
        function showMessage(text, type = 'info') {
            if (!messageElement) return;
            
            messageElement.className = `mt-3 alert alert-${type}`;
            messageElement.textContent = text;
            
            // Auto-masquer après 5 secondes
            setTimeout(() => {
                messageElement.className = 'mt-3';
                messageElement.textContent = '';
            }, 5000);
        }

        // Afficher les icônes populaires
        function showPopularIcons() {
            iconSuggestions.innerHTML = '<div class="list-group-item fw-bold">Icônes populaires</div>';
            displayIcons(popularIcons);
        }

        // Rechercher des icônes via l'API Iconify
        async function searchIcons(query) {
            if (isLoading) return;
            if (!query || query.length < 2) {
                showPopularIcons();
                return;
            }
            
            currentQuery = query;
            isLoading = true;
            iconSuggestions.innerHTML = '<div class="list-group-item text-center"><div class="spinner-border spinner-border-sm" role="status"></div> Chargement...</div>';
            
            try {
                // Utiliser l'API de recherche d'Iconify
                const response = await fetch(`https://api.iconify.design/search?query=${encodeURIComponent(query)}&limit=10`);
                
                if (!response.ok) {
                    throw new Error(`Erreur: ${response.status}`);
                }
                
                const data = await response.json();
                
                // Vérifier si la réponse contient des icônes
                if (!data.icons || data.icons.length === 0) {
                    iconSuggestions.innerHTML = '<div class="list-group-item">Aucun résultat trouvé</div>';
                    return;
                }
                
                // Ne procéder que si on recherche toujours la même requête
                if (query === currentQuery) {
                    iconSuggestions.innerHTML = '';
                    displayIcons(data.icons);
                }
            } catch (error) {
                console.error('Erreur lors de la recherche d\'icônes:', error);
                iconSuggestions.innerHTML = '<div class="list-group-item text-danger">Erreur de connexion à l\'API</div>';
                showMessage('Erreur de connexion à l\'API Iconify. Vérifiez votre connexion internet.', 'danger');
            } finally {
                isLoading = false;
            }
        }

        // Afficher les icônes dans la liste déroulante
        function displayIcons(icons) {
            if (icons.length === 0) {
                iconSuggestions.innerHTML = '<div class="list-group-item">Aucun résultat trouvé</div>';
                return;
            }

            icons.forEach(icon => {
                const item = document.createElement('div');
                item.classList.add('list-group-item', 'list-group-item-action', 'd-flex', 'align-items-center', 'py-3');
                
                // Créer un élément d'icône avec l'API Iconify
                const iconElement = document.createElement('iconify-icon');
                iconElement.setAttribute('icon', icon);
                iconElement.setAttribute('width', '24');
                iconElement.setAttribute('height', '24');
                iconElement.style.marginRight = '10px';
                
                const iconName = document.createElement('span');
                iconName.textContent = icon;
                
                item.appendChild(iconElement);
                item.appendChild(iconName);
                
                item.addEventListener('click', () => {
                    iconInput.value = icon;
                    updatePreview(icon);
                    iconSuggestions.innerHTML = '';
                });
                
                iconSuggestions.appendChild(item);
            });
        }

        // Mettre à jour l'aperçu de l'icône
        function updatePreview(iconName) {
            if (!iconName) {
                iconPreview.innerHTML = '';
                return;
            }
            
            // Créer un élément d'icône pour l'aperçu
            iconPreview.innerHTML = '';
            const previewIcon = document.createElement('iconify-icon');
            previewIcon.setAttribute('icon', iconName);
            previewIcon.setAttribute('width', '48');
            previewIcon.setAttribute('height', '48');
            iconPreview.appendChild(previewIcon);
        }

        // Evénements
        
        // Afficher les icônes populaires lors du focus sur le champ
        iconInput.addEventListener('focus', function() {
            if (iconSuggestions.innerHTML === '') {
                showPopularIcons();
            }
        });

        // Rechercher des icônes pendant la saisie
        iconInput.addEventListener('input', function() {
            const query = this.value.trim();
            searchIcons(query);
        });

        // Fermer la liste en cliquant à l'extérieur
        document.addEventListener('click', function(e) {
            if (!iconSuggestions.contains(e.target) && e.target !== iconInput) {
                iconSuggestions.innerHTML = '';
            }
        });

        // Mettre à jour l'aperçu lorsque la valeur change manuellement
        iconInput.addEventListener('change', function() {
            updatePreview(this.value.trim());
        });

        // Initialiser l'aperçu avec la valeur actuelle du champ
        updatePreview(iconInput.value.trim());
    }

    // Initialiser le sélecteur d'icônes pour le formulaire d'ajout
    initializeIconSelector('icon', 'iconSuggestions', 'iconPreview', 'message');

    // Initialiser le sélecteur d'icônes pour chaque formulaire de modification
    document.querySelectorAll('[id^="updatecategoryModal-"]').forEach(modal => {
        const categoryId = modal.id.split('-')[1];
        initializeIconSelector(`icon-${categoryId}`, `iconSuggestions-${categoryId}`, `iconPreview-${categoryId}`, `message-${categoryId}`);
    });
    // Automatiquement masquer les alertes de succès après 5 secondes
    const successAlert = document.getElementById('successAlert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.remove();
        }, 5000);
    }
});

    function deleteCategory(event) {
        const categoryId = event.target.getAttribute('data-id');
        const row = document.getElementById('category-' + categoryId);
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Cette action est irréversible.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/categories/${categoryId}`, {
                    method: 'DELETE',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                  })
                  
                .then(response => {
                    console.log('Status:', response.status);
                    return response.json().then(data => {
                      console.log('Response data:', data);
                      if (response.ok) {
                        row.remove();
                        Swal.fire('Supprimée!', 'La catégorie a été supprimée avec succès.', 'success');
                      } else {
                        Swal.fire('Erreur!', `Erreur: ${JSON.stringify(data)}`, 'error');
                      }
                    });
                  })
                .catch(error => {
                    console.error('Erreur:', error);
                    Swal.fire(
                        'Erreur!',
                        'Une erreur est survenue. Veuillez réessayer.',
                        'error'
                    );
                });
            }
        });
    }
    







