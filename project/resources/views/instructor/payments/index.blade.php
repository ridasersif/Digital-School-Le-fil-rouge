@extends('layouts.dashboard')

@section('title', 'Listes des paiements')
@push('styles')
{{-- <link rel="stylesheet" href="{{ asset('assets/CSS/auth/auth.css') }}"> --}}
@endpush
@section('contents')

@if(session('success'))
    <div class="alert alert-success" role="alert" id="successAlert">
        {{ session('success') }}
    </div>
@endif

<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Listes des paiements</h1>
</div>
<div class="row">
    <!-- categories -->
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Tous les paiements</h6>
                    <div class="input-group w-50">
                        <span class="input-group-text border-end-0">
                            <i class="fas fa-search text-primary"></i>
                        </span>
                        <input type="text" class="form-control t border-start-0"
                               placeholder="Rechercher un paiement..."
                               aria-label="Rechercher"
                               id="searchInput">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center" id="paymentsTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom de l'étudiant</th>
                                <th>Cours</th>
            
                                <th>Date de paiement</th>
                                <th>Montant</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->inscription->etudiant->user->name }}</td>
                                    <td>{{ $payment->inscription->cours->titre }}</td>
                                   
                                    <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $payment->amount }} MAD</td>
                        
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
      
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

       
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const table = document.getElementById('paymentsTable');
            const rows = table.getElementsByTagName('tr');
            
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;
                
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().indexOf(searchValue) > -1) {
                        found = true;
                        break;
                    }
                }
    
                row.style.display = found ? '' : 'none';
            }
        });
    });
</script>
@endpush
