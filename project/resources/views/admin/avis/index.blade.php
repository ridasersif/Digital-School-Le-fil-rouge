@extends('layouts.dashboard')

@section('title', 'Gestion des Avis')

@push('styles')
<style>
    .rating {
        color: #ffc107;
        font-size: 0.8rem; /* Étoiles plus petites */
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
    .user-info {
        border-left: 3px solid #6c757d;
        padding-left: 15px;
        margin-bottom: 15px;
    }
    .formateur-info {
        border-left: 3px solid #007bff;
    }
</style>
@endpush

@section('contents')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Tous les avis</h4>
                    <span class="badge bg-primary">{{ count($avis) }} avis au total</span>
                </div>
                <div class="card-body">
                    @if($avis->isEmpty())
                        <div class="alert alert-info">
                            Aucun avis n'est disponible dans le système.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Cours</th>
                                        <th>Commentaire</th>
                                        <th>Note</th>
                                        <th>Formateur</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($avis as $a)
                                        <tr>
                                            <td>{{ $a->cours->titre }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($a->commentaire, 20) }}</td>
                                            <td>
                                                <div class="rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $a->note)
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>{{ $a->cours->formateur->user->name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <button type="button" class="btn btn-primary btn-sm me-2" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#avisModal{{ $a->id }}">
                                                        Détails
                                                    </button>
                                                    <form action="{{ route('admin.avis.destroy', $a->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
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
@foreach($avis as $a)
    <div class="modal fade" id="avisModal{{ $a->id }}" tabindex="-1" aria-labelledby="avisModalLabel{{ $a->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="avisModalLabel{{ $a->id }}">Détails de l'avis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Information sur le cours</h6>
                            <p><strong>Titre:</strong> {{ $a->cours->titre }}</p>
                            <p><strong>Description:</strong> {{ \Illuminate\Support\Str::limit($a->cours->description, 100) }}</p>
                            <p><strong>Prix:</strong> {{ $a->cours->price }} DH</p>
                            <p><strong>Statut:</strong> <span class="badge bg-{{ $a->cours->status == 'published' ? 'success' : 'warning' }}">{{ $a->cours->status }}</span></p>
                        </div>
                        
                        <div class="col-md-6">
                            <h6 class="fw-bold">Information sur le formateur</h6>
                            <div class="user-info formateur-info">
                                <div class="d-flex align-items-center mb-2">
                                    @if($a->cours->formateur->user->profile && $a->cours->formateur->user->profile->avatar)
                                        <img src="{{ asset('storage/' . $a->cours->formateur->user->profile->avatar) }}" 
                                            alt="Photo de profil" 
                                            class="rounded-circle me-3" 
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="avatar-placeholder rounded-circle me-3" style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($a->cours->formateur->user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="mb-0 fw-bold">{{ $a->cours->formateur->user->name }}</p>
                                        <p class="mb-0 text-muted">{{ $a->cours->formateur->user->email }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <h6 class="fw-bold mt-3">Information sur l'étudiant</h6>
                            <div class="user-info">
                                <div class="d-flex align-items-center mb-2">
                                    @if($a->etudiant->user->profile && $a->etudiant->user->profile->avatar)
                                        <img src="{{ asset('storage/' . $a->etudiant->user->profile->avatar) }}" 
                                            alt="Photo de profil" 
                                            class="rounded-circle me-3" 
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="avatar-placeholder rounded-circle me-3" style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($a->etudiant->user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="mb-0 fw-bold">{{ $a->etudiant->user->name }}</p>
                                        <p class="mb-0 text-muted">{{ $a->etudiant->user->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h6 class="fw-bold">Avis</h6>
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div class="rating" style="font-size: 1rem;">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $a->note)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        <span class="ms-2">{{ $a->note }}/5</span>
                                    </div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($a->created_at)->format('d/m/Y à H:i') }}</small>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $a->commentaire }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.avis.destroy', $a->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Supprimer l'avis
                        </button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

@push('scripts')

@endpush