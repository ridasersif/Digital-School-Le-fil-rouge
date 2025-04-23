
@extends('layouts.frontend')
@section('title', 'Toute les courses populaires')
@push('style')

   

@endpush

@section('contents')
    <!-- Featured Courses -->
<section class="py-5 bg-light" id="cours">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Cours populaires</h2>
         
        </div>
        <div class="row g-4">
            @forelse($cours as $course)
               
        
                <div class="col-md-6 col-lg-3">
                    <div class="card course-card">
                        <!-- Catégorie -->
                        <span class="badge bg-primary category-badge">
                            {{ $course->category->nom ?? 'Catégorie inconnue' }}
                        </span>
        
                        <!-- Image du cours -->
                        {{-- <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top course-image" alt="Cours"> --}}
                        <a href="{{ route('courses.show', $course->id) }}">
                            {{-- <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top course-image" alt="Cours"> --}}
                            @if($course->image)
                                <a href="{{ route('courses.show', $course->id) }}">
                                    <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top course-image" alt="Cours">
                                </a>
                            @else
                                <a href="{{ route('courses.show', $course->id) }}">
                                    <div class="d-flex justify-content-center align-items-center" style="height: 160px; background-color: #f0f0f0;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                </a>
                            @endif

                        </a>

                        <div class="card-body">
                            <!-- Bestseller + Étoiles -->
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-light text-dark">Bestseller</span>
                                <div>
                                    <i class="fas fa-star text-warning"></i>
                                    <small>4.8 (245)</small>
                                </div>
                            </div>
        
                            <!-- Titre du cours -->
                            <h5 class="card-title">{{ $course->titre }}</h5>
                         
                                 <!-- Formateur -->
                                <p class="card-text small text-muted">
                                    Par {{ $course->formateur->user->name }}
                                </p>


                                @php
                                    $user = Auth::user();
                                    $etudiant = $user->etudiant ?? null;
                                    $isInscrit = false;
                        
                                    if ($etudiant) {
                                        $isInscrit = \App\Models\Inscription::where('etudiant_id', $etudiant->id)
                                                    ->where('cours_id', $course->id)
                                                ->exists();
                
                                    }
                                @endphp
                            @if ($etudiant)
                                        <!-- Bouton dynamique -->
                                @if($isInscrit)
                                    <form action="{{route('student.myCourses.show',$course->id)}}" method="get">
                                        @csrf
                                        <button  class="btn btn-success w-100">Commencer à apprendre </button>
                                    
                                    </form>
                                
                                @else
                                    <form action="{{ route('student.panier.ajouter', $course->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100"> Ajouter au panier</button>
                                    </form>
                                @endif
                            
                            @else
                               
                               
                            @endif
                           
                        </div>
                    </div>
                </div>
            @empty
                <p>Aucun cours trouvé.</p>
            @endforelse
        </div>
     
        
    </div>
    <div class="pagination mt-4">
        {{ $cours->links() }}
    </div>
    
   
</section>

@endsection

@push('script')

@endpush
