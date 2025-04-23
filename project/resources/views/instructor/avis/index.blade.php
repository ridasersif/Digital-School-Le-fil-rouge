@extends('layouts.dashboard')

@section('title', 'Liste des Avis')

@push('styles')
<style>
    .rating {
        color: #ffc107;
    }
    .cours-card {
        margin-bottom: 1.5rem;
    }
    .avis-count {
        font-weight: bold;
        color: #495057;
    }
    .btn-details {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    .modal-avatar {
        width: 60px;
        height: 60px;
        object-fit: cover;
    }
    .avatar-placeholder {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #6c757d;
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
    }
</style>
@endpush

@section('contents')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Avis des étudiants</h4>
                </div>
                <div class="card-body">
                    @php
                        // Filtrer uniquement les cours avec des avis
                        $coursAvecAvisFiltre = $coursAvecAvis->filter(function($cours) {
                            return $cours->avis->count() > 0;
                        });
                    @endphp

                    @if($coursAvecAvisFiltre->isEmpty())
                        <div class="alert alert-info">
                            Aucun avis n'a encore été laissé sur vos cours.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Cours</th>
                                        <th>Commentaire</th>
                                        <th>Note</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coursAvecAvisFiltre as $cours)
                                        @foreach($cours->avis as $avis)
                                            <tr>
                                                <td>{{ $cours->titre }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($avis->commentaire, 20) }}</td>
                                                <td>
                                                    <div class="rating">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $avis->note)
                                                                <i class="fas fa-star"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-details" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#avisModal{{ $avis->id }}">
                                                        Détails
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals pour chaque avis -->
@foreach($coursAvecAvisFiltre as $cours)
    @foreach($cours->avis as $avis)
        <div class="modal fade" id="avisModal{{ $avis->id }}" tabindex="-1" aria-labelledby="avisModalLabel{{ $avis->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="avisModalLabel{{ $avis->id }}">Détails de l'avis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Information sur le cours</h6>
                                <p><strong>Titre:</strong> {{ $cours->titre }}</p>
                                <p><strong>Description:</strong> {{ \Illuminate\Support\Str::limit($cours->description, 100) }}</p>
                                <p><strong>Prix:</strong> {{ $cours->price }} DH</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Information sur l'étudiant</h6>
                                <div class="d-flex align-items-center mb-3">
                                    @if($avis->etudiant->user->profile->avatar)
                                        <img src="{{ asset('storage/' . $avis->etudiant->user->profile->avatar) }}" 
                                            alt="Photo de profil" 
                                            class="rounded-circle me-3 modal-avatar">
                                    @else
                                        <div class="avatar-placeholder rounded-circle me-3">
                                            {{ strtoupper(substr($avis->etudiant->user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="mb-0 fw-bold">{{ $avis->etudiant->user->name }}</p>
                                        <p class="mb-0 text-muted">{{ $avis->etudiant->user->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h6 class="fw-bold">Avis</h6>
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <div class="rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $avis->note)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            <span class="ms-2">{{ $avis->note }}/5</span>
                                        </div>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($avis->created_at)->format('d/m/Y à H:i') }}</small>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ $avis->commentaire }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialisation des modales Bootstrap si nécessaire
        var avisModals = document.querySelectorAll('.modal');
        if (typeof bootstrap !== 'undefined') {
            avisModals.forEach(function(modal) {
                new bootstrap.Modal(modal);
            });
        }
    });
</script>
@endpush