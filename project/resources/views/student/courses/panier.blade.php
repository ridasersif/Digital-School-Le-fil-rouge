@extends('layouts.frontend')
@section('contents')


    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .course-img {
            height: 140px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .rating-stars {
            color: #f7c32e;
        }
        .btn-primary {
            background-color: #7952b3;
            border-color: #7952b3;
        }
        .btn-primary:hover {
            background-color: #614092;
            border-color: #614092;
        }
        .btn-outline-primary {
            color: #7952b3;
            border-color: #7952b3;
        }
        .btn-outline-primary:hover {
            background-color: #7952b3;
            color: white;
        }
        .badge-update {
            background-color: #28a745;
            color: white;
        }
        .promo-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            background-color: #dc3545;
            color: white;
            border-radius: 5px;
            font-weight: bold;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: #7952b3;
        }
        .cart-summary {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            padding: 20px;
            z-index: 10;
            border: solid .2px hsl(266, 60%, 50%);
            transition: transform 0.3s;
        }
        .cart-summary:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(146, 77, 152, 0.1);
        }
        .instructor-badge {
            display: inline-block;
            margin-right: 5px;
        }
        .instructor-img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>


    <div class="container mb-5">
            <div class="col-12">
                <h1 class="mb-4 fw-bold">Mon Panier</h1>
            </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>  {{ $nombreDeCours }} cours dans le panier</h5>
                            @if($cours->count() > 0)
                            <form action="{{ route('student.panier.vider') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir vider le panier ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn text-decoration-none text-danger">
                                    <i class="fas fa-trash-alt me-1"></i> Vider le panier
                                </button>
                            </form>
                        @endif
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @foreach($cours as $cour)
                            <div class="row g-0 border-bottom p-3">
                                <div class="col-md-2 mb-3 mb-md-0">
                                    <img src="{{ asset('storage/' . $cour->image) }}" alt="{{ $cour->titre }}" class="img-fluid rounded">
                                </div>
                                <div class="col-md-7 ps-md-3">
                                    <h5 class="mb-1">{{ $cour->titre }}</h5>
                                    <p class="mb-1 text-muted small">
                                        Par {{ $cour->formateur->user->name }}
                                        @if($cour->formateur->user->profile)
                                            <img src="{{ asset('storage/'.$cour->formateur->user->profile->avatar) }}" class="instructor-img ms-1" alt="Avatar">
                                        @endif
                                    </p>
                    
                                    <div class="mb-1">
                                        <span class="badge bg-secondary me-1">{{ $cour->duree ?? 'Durée inconnue' }}</span>
                                        <span class="badge bg-secondary me-1">{{ $cour->contents_count }} contenus</span>
                                        <span class="badge bg-secondary">{{ $cour->niveau ?? 'Tous niveaux' }}</span>
                                    </div>
                                    
                                    <div class="mb-2">
                                        <span class="fw-bold">Note: 4,6</span> 
                                        <span class="rating-stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </span>
                                        <span class="text-muted">(135 avis)</span>
                                    </div>
                    
                                    <div class="d-flex">
                                        <a href="#" class="text-decoration-none me-3"><i class="far fa-heart me-1"></i> Sauvegarder</a>
                                        <form action="{{ route('student.panier.delete', $cour->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cours du panier ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-decoration-none text-danger p-0 m-0">
                                                <i class="fas fa-trash-alt me-1"></i> Supprimer
                                            </button>
                                        </form>
                                        
                                        {{-- <a href="#" class="text-decoration-none text-danger"><i class="fas fa-trash-alt me-1"></i> Supprimer</a> --}}
                                    </div>
                                </div>
                    
                                <div class="col-md-3 text-md-end mt-3 mt-md-0">
                                    <h5 class="fw-bold">{{ number_format($cour->price, 2) }} MAD</h5>
                                    @if($cour->old_price)
                                        <p class="text-muted text-decoration-line-through mb-0">{{ number_format($cour->old_price, 2) }} MAD</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-4 pagination d-flex justify-content-end">
                            {{-- Pagination --}}
                            {{ $cours->links() }}
                          
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Cart Summary -->
            @if($cours->isNotEmpty())
            <div class="col-lg-4">
                <div class="cart-summary sticky-lg-top" style="top: 20px;">
                    <h4 class="mb-4">Résumé de la commande</h4>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Prix original:</span>
                        <span class="text-muted text-decoration-line-through">{{ number_format($cours->sum('old_price') ?? $cours->sum('price'), 2) }} MAD</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Prix réduit:</span>
                        <span>{{ number_format($cours->sum('price'), 2) }} MAD</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <span>Vous économisez:</span>
                        @php
                            $totalOld = $cours->sum('old_price') ?? $cours->sum('price');
                            $total = $cours->sum('price');
                            $saving = $totalOld - $total;
                            $savingPercent = $totalOld > 0 ? round(($saving / $totalOld) * 100) : 0;
                        @endphp
                        <span class="text-success">{{ number_format($saving, 2) }} MAD ({{ $savingPercent }}%)</span>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold">Total:</span>
                        <span class="fw-bold fs-4">{{ number_format($cours->sum('price'), 2) }} MAD</span>
                    </div>
                   
                    <form action="{{ route('payment.page') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                            <i class="fas fa-lock me-2"></i> Payer maintenant
                        </button>
                    </form>
                    
                    
                    
                    
                    <p class="text-center text-muted small mb-0">Vous ne serez pas encore débité</p>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-center gap-1">
                       

                        <img src="{{asset('assets/images/cartePaiment/imag2.png')}}" width="70px" height="50px" alt="Visa" class="img-fluid">
                        <img src="{{asset('assets/images/cartePaiment/imag1.png')}}" width="70px" height="50px" alt="Mastercard" class="img-fluid">
                        <img src="{{asset('assets/images/cartePaiment/image5.png')}}" width="70px" height="50px" class="img-fluid">
                        <img src="{{asset('assets/images/cartePaiment/image6.png')}}" width="70px" height="50px" alt="Apple Pay" class="img-fluid">
                    </div>
                    
                    <hr>
                    
                    <div class="text-center">
                        <p class="mb-2"><strong>Garantie de satisfaction de 30 jours</strong></p>
                        <p class="text-muted small">Si vous n'êtes pas satisfait, nous vous remboursons intégralement dans les 30 jours suivant l'achat.</p>
                    </div>
                </div>
            </div>
        @endif
        </div>
    </div>
@endsection

























