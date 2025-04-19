

@extends('layouts.frontend')
@section('contents')
    <style>
        .payment-container {
            max-width: 1100px;
            margin: 0 auto;
        }
        .payment-header {
            border-bottom: 1px solid #e5e5e5;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
        }
        .course-info {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .course-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .course-meta {
            color: #6c757d;
            font-size: 0.9rem;
        }
        .payment-box {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 20px;
        }
        .payment-summary {
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            padding: 20px;
        }
        .payment-method-label {
            display: block;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .payment-method-label:hover {
            border-color: #7952b3;
        }
        .payment-method-label.selected {
            border-color: #7952b3;
            background-color: #f8f4ff;
        }
        .card-element {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: white;
        }
        .btn-pay {
            background-color: #7952b3;
            border-color: #7952b3;
            color: white;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-pay:hover {
            background-color: #614092;
            border-color: #614092;
        }
        .payment-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 1rem;
        }
        .payment-icon {
            width: 50px;
            height: 35px;
            object-fit: contain;
        }
        .loader {
            display: none;
            border: 3px solid #f3f3f3;
            border-radius: 50%;
            border-top: 3px solid #7952b3;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .payment-secure-badge {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: #28a745;
            margin-top: 15px;
        }
        .payment-secure-badge i {
            margin-right: 5px;
        }
    </style>

    <div class="container payment-container py-5">
        <div class="payment-header">
            <h2 class="mb-1">Finaliser votre commande</h2>
            <p class="text-muted">Veuillez compléter votre paiement pour accéder à vos cours</p>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Courses Information -->
                <div class="payment-box mb-4">
                    <h4 class="mb-3">Résumé de votre commande</h4>
                    <div id="cours-list">
                        @if(count($panierCours) == 0)
                            <div class="alert alert-info">Votre panier est vide</div>
                        @else
                            @foreach($panierCours as $cours)
                                <div class="d-flex mb-3 pb-3 border-bottom">
                                    <div class="flex-shrink-0" style="width: 80px">
                                        <img src="{{ asset('storage/' . $cours->image) }}" alt="{{ $cours->titre }}" class="img-fluid rounded">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="course-title">{{ $cours->titre }}</h5>
                                        <div class="course-meta">
                                            <span>Par {{ $cours->formateur->user->name }}</span>
                                            <span class="ms-2">{{ $cours->duree ?? 'Durée inconnue' }}</span>
                                            <span class="ms-2">{{ $cours->niveau ?? 'Tous niveaux' }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 text-end" style="min-width: 80px">
                                        <h6 class="mb-0">{{ number_format($cours->price, 2) }} MAD</h6>
                                        @if($cours->old_price)
                                            <small class="text-muted text-decoration-line-through">{{ number_format($cours->old_price, 2) }} MAD</small>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="payment-box">
                    <h4 class="mb-3">Méthode de paiement</h4>
                    
                    <div class="mb-4">
                        <label class="payment-method-label selected">
                            <input type="radio" name="payment_method" value="card" checked class="me-2">
                            <span>Carte de crédit / débit</span>
                        </label>
                    </div>

                    <form id="payment-form">
                        <div class="mb-4">
                            <label class="form-label">Informations de carte</label>
                            <div id="card-element" class="card-element mb-2"></div>
                            <div id="card-errors" class="text-danger small" role="alert"></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" id="pay-button" class="btn btn-pay">
                                <span class="loader" id="payment-loader"></span>
                                <span id="button-text">Payer maintenant</span>
                            </button>
                            <div class="payment-secure-badge">
                                <i class="fas fa-lock"></i> Paiement 100% sécurisé
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Order Summary -->
                <div class="payment-summary">
                    <h4 class="mb-3">Détails de la commande</h4>
                    
                    <div id="payment-summary">
                        @php
                            $totalOld = $panierCours->sum(function ($cours) {
                                return $cours->old_price ? $cours->old_price : $cours->price;
                            });
                            $total = $panierCours->sum('price');
                            $saving = $totalOld - $total;
                            $savingPercent = $totalOld > 0 ? round(($saving / $totalOld) * 100) : 0;
                        @endphp

                        <div class="d-flex justify-content-between mb-2">
                            <span>Prix original:</span>
                            <span class="text-muted text-decoration-line-through">{{ number_format($totalOld, 2) }} MAD</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Prix réduit:</span>
                            <span>{{ number_format($total, 2) }} MAD</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Vous économisez:</span>
                            <span class="text-success">{{ number_format($saving, 2) }} MAD ({{ $savingPercent }}%)</span>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-0">
                            <span class="h5 fw-bold">Total:</span>
                            <span class="h5 fw-bold">{{ number_format($total, 2) }} MAD</span>
                        </div>
                    </div>

                    <hr>
                    
                    <div class="payment-icons">
                        <img src="{{asset('assets/images/cartePaiment/imag2.png')}}" alt="Visa" class="payment-icon">
                        <img src="{{asset('assets/images/cartePaiment/imag1.png')}}" alt="Mastercard" class="payment-icon">
                        <img src="{{asset('assets/images/cartePaiment/image5.png')}}" alt="PayPal" class="payment-icon">
                        <img src="{{asset('assets/images/cartePaiment/image6.png')}}" alt="Apple Pay" class="payment-icon">
                    </div>
                    
                    <hr>
                    
                    <div class="text-center">
                        <p class="mb-1"><strong>Garantie de satisfaction de 7 jours</strong></p>
                        <p class="text-muted small">Si vous n'êtes pas satisfait, nous vous remboursons intégralement dans les 7 jours suivant l'achat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Initialize Stripe
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        let card;
        
        document.addEventListener('DOMContentLoaded', function() {
            initializeStripe();
        });
        
        function initializeStripe() {
            // Create payment intent
            fetch("{{ route('payment.intent') }}")
                .then(response => response.json())
                .then(data => {
                    // Create card element
                    const elements = stripe.elements();
                    card = elements.create("card", {
                        style: {
                            base: {
                                color: "#32325d",
                                fontFamily: 'Arial, sans-serif',
                                fontSmoothing: "antialiased",
                                fontSize: "16px",
                                "::placeholder": {
                                    color: "#aab7c4"
                                }
                            },
                            invalid: {
                                color: "#fa755a",
                                iconColor: "#fa755a"
                            }
                        }
                    });
                    card.mount("#card-element");
                    
                    // Handle validation errors
                    card.addEventListener('change', function(event) {
                        const displayError = document.getElementById('card-errors');
                        if (event.error) {
                            displayError.textContent = event.error.message;
                        } else {
                            displayError.textContent = '';
                        }
                    });
                    
                    // Handle form submission
                    const form = document.getElementById('payment-form');
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        setLoading(true);
                        
                        stripe.confirmCardPayment(data.clientSecret, {
                            payment_method: {
                                card: card,
                                billing_details: {
                                    name: "{{ Auth::user()->name }}"
                                }
                            }
                        }).then(function(result) {
                            setLoading(false);
                            
                            if (result.error) {
                                // Show error message
                                const errorElement = document.getElementById('card-errors');
                                errorElement.textContent = result.error.message;
                            } else {
                                // Payment successful
                                if (result.paymentIntent.status === 'succeeded') {
                                    showSuccessMessage();
                                    // Redirect to success page after 2 seconds
                                    setTimeout(function() {
                                        window.location.href = "{{ route('payment.success') }}";
                                    }, 2000);
                                }
                            }
                        });
                    });
                })
                .catch(error => {
                    console.error('Error initializing payment:', error);
                    document.getElementById('card-errors').textContent = "Erreur lors de l'initialisation du paiement. Veuillez réessayer.";
                });
        }
        
        function setLoading(isLoading) {
            const payButton = document.getElementById('pay-button');
            const loader = document.getElementById('payment-loader');
            const buttonText = document.getElementById('button-text');
            
            if (isLoading) {
                payButton.disabled = true;
                loader.style.display = 'inline-block';
                buttonText.textContent = 'Traitement en cours...';
            } else {
                payButton.disabled = false;
                loader.style.display = 'none';
                buttonText.textContent = 'Payer maintenant';
            }
        }
        
        function showSuccessMessage() {
            const form = document.getElementById('payment-form');
            form.innerHTML = `
                <div class="alert alert-success text-center">
                    <i class="fas fa-check-circle fa-3x mb-3"></i>
                    <h4>Paiement réussi!</h4>
                    <p>Vous allez être redirigé vers vos cours...</p>
                </div>
            `;
        }
    </script>
@endsection