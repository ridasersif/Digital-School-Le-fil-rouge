@extends('layouts.dashboard')

@section('title', 'Étudiants inscrits')

@push('styles')
<style>
    .student-card {
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        margin-bottom: 20px;
    }
    
    .student-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }
    
    .avatar-container {
        width: 60px;
        height: 60px;
        overflow: hidden;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-right: 15px;
    }
    
    .avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .card-header {
        background-color: #f8f9fa;
        border-radius: 10px 10px 0 0;
        border-bottom: 1px solid #eee;
    }
    
    .student-info {
        display: flex;
        align-items: center;
    }
    
    .student-name {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.2rem;
    }
    
    .student-email {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .course-badge {
        background-color: #e9f2ff;
        color: #0d6efd;
        border-radius: 20px;
        padding: 5px 12px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .view-btn {
        border-radius: 20px;
        padding: 5px 15px;
        transition: all 0.3s;
    }
    
    .view-btn:hover {
        transform: scale(1.05);
    }
    
    .modal-content {
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }
    
    .modal-header {
        background-color: #f8f9fa;
        border-radius: 15px 15px 0 0;
    }
    
    .profile-detail {
        padding: 8px 0;
        border-bottom: 1px dashed #eee;
    }
    
    .profile-detail:last-child {
        border-bottom: none;
    }
    
    .section-title {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 4px;
        width: 50px;
        background-color: #0d6efd;
        border-radius: 2px;
    }
    
    .search-container {
        margin-bottom: 20px;
    }
</style>
@endpush

@section('contents')
<div class="container-fluid">
    <h2 class="section-title">Liste des étudiants inscrits à vos cours</h2>
    
    <div class="row search-container">
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" id="searchInput" placeholder="Rechercher un étudiant...">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    
    <div class="row">
        @foreach($inscriptions as $index => $inscription)
            @php
                $etudiant = $inscription->etudiant->user;
                $profile = $etudiant->profile;
            @endphp
            <div class="col-md-6 col-lg-4">
                <div class="card student-card">
                    <div class="card-header py-3">
                        <div class="student-info">
                            <div class="avatar-container">
                                <img src="{{ asset('storage/' . ($profile->avatar ?? 'default-avatar.png')) }}" alt="avatar" class="avatar">
                            </div>
                            <div>
                                <h5 class="student-name">{{ $etudiant->name }}</h5>
                                <p class="student-email">{{ $etudiant->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="course-badge">{{ $inscription->cours->titre }}</span>
                            <button class="btn btn-primary view-btn" data-bs-toggle="modal" data-bs-target="#modalEtudiant{{ $index }}">
                                <i class="fas fa-eye me-1"></i> Détails
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="modalEtudiant{{ $index }}" tabindex="-1" aria-labelledby="modalLabel{{ $index }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel{{ $index }}">
                                <i class="fas fa-user-graduate me-2"></i>
                                Détails de l'étudiant
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center mb-4">
                                <div class="avatar-container mx-auto" style="width: 100px; height: 100px;">
                                    <img src="{{ asset('storage/' . ($profile->avatar ?? 'default-avatar.png')) }}" alt="avatar" class="avatar">
                                </div>
                                <h4 class="mt-3">{{ $etudiant->name }}</h4>
                            </div>
                            
                            <div class="profile-detail">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                <strong>Email:</strong> {{ $etudiant->email }}
                            </div>
                            <div class="profile-detail">
                                <i class="fas fa-phone text-primary me-2"></i>
                                <strong>Téléphone:</strong> {{ $profile->telephone ?? 'Non défini' }}
                            </div>
                            <div class="profile-detail">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                <strong>Adresse:</strong> {{ $profile->adresse ?? 'Non définie' }}
                            </div>
                            <div class="profile-detail">
                                <i class="fas fa-birthday-cake text-primary me-2"></i>
                                <strong>Date de naissance:</strong> {{ $profile->date_naissance ?? 'Non définie' }}
                            </div>
                            <div class="profile-detail">
                                <i class="fas fa-book text-primary me-2"></i>
                                <strong>Cours:</strong> {{ $inscription->cours->titre }}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary">Contacter</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{($inscriptions->links())}}
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
      
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('keyup', function() {
            const value = this.value.toLowerCase();
            const cards = document.querySelectorAll('.student-card');
            
            cards.forEach(card => {
                const name = card.querySelector('.student-name').innerText.toLowerCase();
                const email = card.querySelector('.student-email').innerText.toLowerCase();
                const course = card.querySelector('.course-badge').innerText.toLowerCase();
                
                if (name.includes(value) || email.includes(value) || course.includes(value)) {
                    card.closest('.col-md-6').style.display = '';
                } else {
                    card.closest('.col-md-6').style.display = 'none';
                }
            });
        });
    });
</script>
@endpush