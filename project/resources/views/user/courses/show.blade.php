{{-- ditay de cours --}}
@extends('layouts.frontend')

@push('style')

{{-- <style>
    /* Course Detail Page Styling */
.course-header {
    background-color: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transition: transform 0.3s;
}

.course-header:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.instructor-avatar {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid var(--primary-color);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.instructor-avatar:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.course-image {
    border-radius: 8px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    margin-bottom: 1.5rem;
}

.video-container {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    margin-bottom: 1.5rem;
}

.category-badge {
    background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
    color: white;
    border-radius: 20px;
    padding: 8px 16px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    box-shadow: 0 2px 8px rgba(109, 40, 210, 0.4);
}

.price-tag {
    
    background-color: var(--card-bg);
    border-radius: 8px;
    padding: 1rem;
    border-left: 4px solid var(--primary-color);
    background-color: #938bee3f
  
}

.current-price {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--primary-color);
}

.old-price {
    font-size: 1.1rem;
    color: #6c757d;
    text-decoration: line-through;
}

.discount-badge {
    background: linear-gradient(45deg, #ff6b6b, #ee5253);
    color: white;
    border-radius: 20px;
    padding: 5px 10px;
    font-size: 0.8rem;
    font-weight: 600;
}

.course-section {
    background: var(--card-bg);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transition: transform 0.3s;
}

.course-section:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.section-title {
    color: var(--text-color);
    font-weight: 600;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-title i {
    color: var(--primary-color);
}

.enroll-btn {
    background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
    border: none;
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(109, 40, 210, 0.4);
    transition: all 0.3s ease;
}

.enroll-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(109, 40, 210, 0.6);
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 1rem;
    border-radius: 8px;
  
    margin-bottom: 1rem;
    transition: all 0.3s ease;
    border: solid 1px rgba(150, 57, 232, 0.304)


}

.stat-card:hover {
    background-color: rgba(116, 61, 179, 0.188);
    color: white;
    transform: translateX(5px);
}

.stat-card:hover .stat-label,
.stat-card:hover .stat-value {
    color: white;
}

.stat-icon {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
    color: white;
    font-size: 1.2rem;
 
}

.stat-info {
    flex-grow: 1;
}

.stat-label {
    font-size: 0.85rem;
    color: #6c757d;
    margin-bottom: 0.2rem;
    transition: color 0.3s;
}

.stat-value {
    font-weight: 600;
    color: var(--text-color);
    margin: 0;
    transition: color 0.3s;
}

.social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--bg-color);
    color: var(--primary-color);
    margin-right: 10px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.social-link:hover {
    background-color: var(--primary-color);
    color: white;
    transform: translateY(-2px) rotate(5deg);
}

.content-section {
    border-left: 2px solid var(--primary-color);
    padding-left: 20px;
    margin-bottom: 1.5rem;
    transition: padding-left 0.3s;
  
}

.content-section:hover {
    padding-left: 25px;
}

.content-header {
    margin-bottom: 1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.content-header i {
    color: var(--primary-color);
}

.no-content {
    text-align: center;
    padding: 3rem 0;
    color: #6c757d;
}

.no-content i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: var(--card-border);
}

/* Dark mode specific adjustments */
[data-bs-theme="dark"] .stat-card {
    background-color: #2d3338;
}

[data-bs-theme="dark"] .stat-value {
    color: #f8f9fa;
}

[data-bs-theme="dark"] .no-content i {
    color: #495057;
}

/* Responsive adjustments */
@media (max-width: 991px) {
    .course-header {
        padding: 1.5rem;
    }
    
    .instructor-avatar {
        width: 50px;
        height: 50px;
    }
    
    .current-price {
        font-size: 1.5rem;
    }
}

@media (max-width: 767px) {
    .course-header {
        padding: 1rem;
    }
    
    .enroll-btn {
        padding: 10px 20px;
    }
}
.custom-alert {
            position: fixed;
            top: 50px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
            max-width: 400px;
            padding: 15px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            font-size: 15px;
            opacity: 0.95;
            transition: opacity 0.3s ease-in-out;
        }
        .custom-alert i {
            font-size: 18px;
        }
        .custom-alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        .custom-alert-info {
            background-color: #cff4fc;
            color: #055160;
        }
        .custom-alert-error {
            background-color: #f8d7da;
            color: #842029;
        }
</style> --}}

<style>
    /* Course Detail Page Styling - Modern & Responsive */
.course-header {
    background: linear-gradient(to right, rgba(var(--bs-primary-rgb), 0.05), rgba(var(--bs-primary-rgb), 0.1));
    border: none;
    border-radius: 16px;
    padding: 2.5rem;
    margin-bottom: 2.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.course-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 6px;
    height: 100%;
    background: linear-gradient(to bottom, var(--bs-primary), var(--bs-info));
    border-radius: 3px;
}

.course-header:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(var(--bs-primary-rgb), 0.15);
}

.instructor-avatar {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid var(--bs-primary);
    box-shadow: 0 5px 15px rgba(var(--bs-primary-rgb), 0.3);
    transition: all 0.4s ease;
}

.instructor-avatar:hover {
    transform: scale(1.08) rotate(5deg);
    box-shadow: 0 8px 20px rgba(var(--bs-primary-rgb), 0.4);
}

.course-image {
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 1.8rem;
    transition: all 0.4s ease;
    transform: perspective(1000px) rotateY(-3deg);
    border: 4px solid #fff;
}

.course-image:hover {
    transform: perspective(1000px) rotateY(0deg);
    box-shadow: 0 15px 35px rgba(var(--bs-primary-rgb), 0.2);
}

.video-container {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 1.8rem;
    border: 4px solid #fff;
    transition: all 0.4s ease;
}

.video-container:hover {
    transform: scale(1.02);
    box-shadow: 0 15px 35px rgba(var(--bs-primary-rgb), 0.2);
}

.category-badge {
    background: linear-gradient(45deg, var(--bs-primary), var(--bs-info));
    color: white;
    border-radius: 30px;
    padding: 10px 20px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    box-shadow: 0 5px 15px rgba(var(--bs-primary-rgb), 0.3);
    transition: all 0.3s ease;
    z-index: 1;
}

.category-badge:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(var(--bs-primary-rgb), 0.4);
}

.price-tag {
    background: linear-gradient(to right, rgba(var(--bs-primary-rgb), 0.1), rgba(var(--bs-primary-rgb), 0.05));
    border-radius: 12px;
    padding: 1.3rem;
    border-left: 5px solid var(--bs-primary);
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.price-tag:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(var(--bs-primary-rgb), 0.15);
}

.current-price {
    font-size: 2rem;
    font-weight: 700;
    background: linear-gradient(45deg, var(--bs-primary), var(--bs-info));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 2px 10px rgba(var(--bs-primary-rgb), 0.2);
}

.old-price {
    font-size: 1.2rem;
    color: var(--bs-secondary);
    text-decoration: line-through;
    margin-right: 10px;
}

.discount-badge {
    background: linear-gradient(45deg, #d37878, #ee5253);
    color: white;
    border-radius: 30px;
    padding: 6px 12px;
    font-size: 0.85rem;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(238, 82, 83, 0.3);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

.course-section {
    background: var(--bs-body-bg);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.course-section::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, transparent 70%, rgba(var(--bs-primary-rgb), 0.1) 100%);
    border-radius: 0 0 16px 0;
}

.course-section:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(var(--bs-primary-rgb), 0.15);
}

.section-title {
    color: var(--bs-body-color);
    font-weight: 700;
    margin-bottom: 1.8rem;
    display: flex;
    align-items: center;
    gap: 12px;
    position: relative;
    padding-bottom: 15px;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(to right, var(--bs-primary), transparent);
    border-radius: 3px;
}

.section-title i {
    color: var(--bs-primary);
    font-size: 1.3rem;
}

.enroll-btn {
    background: linear-gradient(45deg, var(--bs-primary), var(--bs-info));
    border: none;
    border-radius: 12px;
    padding: 14px 28px;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: 0 8px 20px rgba(var(--bs-primary-rgb), 0.3);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.enroll-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, var(--bs-info), var(--bs-primary));
    transition: all 0.5s ease;
    z-index: -1;
}

.enroll-btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(var(--bs-primary-rgb), 0.4);
}

.enroll-btn:hover::before {
    left: 0;
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 18px;
    padding: 1.2rem;
    border-radius: 12px;
    margin-bottom: 1.2rem;
    transition: all 0.4s ease;
    border: 1px solid rgba(var(--bs-primary-rgb), 0.1);
    background: linear-gradient(to right, rgba(var(--bs-primary-rgb), 0.02), rgba(var(--bs-primary-rgb), 0.06));
}

.stat-card:hover {
    background: linear-gradient(to right, rgba(var(--bs-primary-rgb), 0.1), rgba(var(--bs-primary-rgb), 0.15));
    transform: translateX(8px);
    box-shadow: 0 8px 20px rgba(var(--bs-primary-rgb), 0.15);
}

.stat-card:hover .stat-label,
.stat-card:hover .stat-value {
    color: var(--bs-primary);
}

.stat-icon {
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: linear-gradient(45deg, var(--bs-primary), var(--bs-info));
    color: white;
    font-size: 1.3rem;
    box-shadow: 0 8px 20px rgba(var(--bs-primary-rgb), 0.3);
    transition: all 0.4s ease;
}

.stat-card:hover .stat-icon {
    transform: rotate(15deg) scale(1.1);
    box-shadow: 0 10px 25px rgba(var(--bs-primary-rgb), 0.4);
}

.stat-info {
    flex-grow: 1;
}

.stat-label {
    font-size: 0.9rem;
    color: var(--bs-secondary);
    margin-bottom: 0.3rem;
    transition: color 0.3s;
    font-weight: 500;
}

.stat-value {
    font-weight: 700;
    color: var(--bs-body-color);
    margin: 0;
    transition: color 0.3s;
    font-size: 1.1rem;
}

.social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(to right, rgba(var(--bs-primary-rgb), 0.1), rgba(var(--bs-primary-rgb), 0.05));
    color: var(--bs-primary);
    margin-right: 12px;
    transition: all 0.4s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.social-link:hover {
    background: linear-gradient(45deg, var(--bs-primary), var(--bs-info));
    color: white;
    transform: translateY(-5px) rotate(10deg);
    box-shadow: 0 10px 25px rgba(var(--bs-primary-rgb), 0.3);
}

.content-section {
    border-left: 3px solid var(--bs-primary);
    padding-left: 25px;
    margin-bottom: 2rem;
    transition: all 0.3s ease;
    position: relative;
}

.content-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: -9px;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background: var(--bs-primary);
    box-shadow: 0 0 0 5px rgba(var(--bs-primary-rgb), 0.2);
}

.content-section:hover {
    padding-left: 30px;
    border-left-width: 5px;
}

.content-section:hover::before {
    box-shadow: 0 0 0 8px rgba(var(--bs-primary-rgb), 0.2);
}

.content-header {
    margin-bottom: 1.2rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 12px;
}

.content-header i {
    color: var(--bs-primary);
}

.no-content {
    text-align: center;
    padding: 4rem 0;
    color: var(--bs-secondary);
    background: linear-gradient(to right, rgba(var(--bs-primary-rgb), 0.02), rgba(var(--bs-primary-rgb), 0.06));
    border-radius: 12px;
    border: 1px dashed rgba(var(--bs-primary-rgb), 0.2);
}

.no-content i {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    color: rgba(var(--bs-primary-rgb), 0.3);
}

.custom-alert {
    position: fixed;
    top: 30px;
    right: 30px;
    z-index: 1050;
    min-width: 320px;
    max-width: 400px;
    padding: 18px 25px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    font-size: 16px;
    opacity: 0.98;
    transition: all 0.4s ease;
    border-left: 5px solid;
    transform: translateX(100%);
    animation: slide-in 0.5s forwards, fade-out 0.5s 2.5s forwards;
}

@keyframes slide-in {
    to { transform: translateX(0); }
}

@keyframes fade-out {
    to { opacity: 0; transform: translateY(-20px); }
}

.custom-alert i {
    font-size: 22px;
}

.custom-alert-success {
    background-color: #e8f5e9;
    color: #2e7d32;
    border-color: #2e7d32;
}

.custom-alert-info {
    background-color: #e3f2fd;
    color: #0277bd;
    border-color: #0277bd;
}

.custom-alert-error {
    background-color: #fbe9e7;
    color: #c62828;
    border-color: #c62828;
}

/* Dark mode specific adjustments */
[data-bs-theme="dark"] .course-header {
    background: linear-gradient(to right, rgba(var(--bs-primary-rgb), 0.15), rgba(var(--bs-primary-rgb), 0.08));
}

[data-bs-theme="dark"] .course-image,
[data-bs-theme="dark"] .video-container {
    border-color: #2d3748;
}

[data-bs-theme="dark"] .price-tag {
    background: linear-gradient(to right, rgba(var(--bs-primary-rgb), 0.2), rgba(var(--bs-primary-rgb), 0.1));
}

[data-bs-theme="dark"] .stat-card {
    background: linear-gradient(to right, rgba(var(--bs-primary-rgb), 0.1), rgba(var(--bs-primary-rgb), 0.05));
    border-color: rgba(var(--bs-primary-rgb), 0.2);
}

[data-bs-theme="dark"] .stat-card:hover {
    background: linear-gradient(to right, rgba(var(--bs-primary-rgb), 0.2), rgba(var(--bs-primary-rgb), 0.1));
}

[data-bs-theme="dark"] .no-content {
    background: rgba(var(--bs-primary-rgb), 0.08);
    border-color: rgba(var(--bs-primary-rgb), 0.2);
}

[data-bs-theme="dark"] .custom-alert-success {
    background-color: rgba(46, 125, 50, 0.2);
    color: #81c784;
}

[data-bs-theme="dark"] .custom-alert-info {
    background-color: rgba(2, 119, 189, 0.2);
    color: #64b5f6;
}

[data-bs-theme="dark"] .custom-alert-error {
    background-color: rgba(198, 40, 40, 0.2);
    color: #ef9a9a;
}

/* Responsive adjustments */
@media (max-width: 991px) {
    .course-header {
        padding: 1.8rem;
    }
    
    .instructor-avatar {
        width: 60px;
        height: 60px;
    }
    
    .current-price {
        font-size: 1.7rem;
    }
    
    .course-section {
        padding: 1.5rem;
    }
}

@media (max-width: 767px) {
    .course-header {
        padding: 1.5rem;
    }
    
    .enroll-btn {
        padding: 12px 22px;
    }
    
    .category-badge {
        padding: 8px 16px;
    }
    
    .stat-icon {
        width: 45px;
        height: 45px;
    }
}
</style>
@endpush

@section('contents')
@if (session('success'))
<div class="custom-alert custom-alert-success" id="alert-message">
    <i class="fas fa-check-circle"></i>
    {{ session('success') }}
</div>
@endif

@if (session('info'))
<div class="custom-alert custom-alert-info" id="alert-message">
    <i class="fas fa-info-circle"></i>
    {{ session('info') }}
</div>
@endif

@if (session('error'))
<div class="custom-alert custom-alert-error" id="alert-message">
    <i class="fas fa-exclamation-triangle"></i>
    {{ session('error') }}
</div>
@endif

<div class="container py-5">
    <!-- Section d’en-tête du cours -->
    <div class="course-header">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <span class="category-badge">
                        <iconify-icon icon="{{ $course->category->icon }}"></iconify-icon>
                        {{ $course->category->nom }}
                    </span>
                    <span class="badge bg-{{ $course->status == 'published' ? 'success' : 'warning' }}">
                        {{ ucfirst($course->status) }}
                    </span>
                </div>
                
                <h1 class="mb-4">{{ $course->titre }}</h1>
                
               
                <div class="d-flex align-items-center mb-4">
                    @php
                    @endphp
                    @if($course->formateur->user->profile && $course->formateur->user->profile->avatar)
                        <img src="{{ asset('storage/' . $course->formateur->user->profile->avatar) }}"
                             class="instructor-avatar me-3"
                             alt="{{ $course->formateur->user->name }}">
                    @else
                        <div class="instructor-avatar me-3 bg-secondary d-flex align-items-center justify-content-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                    @endif

                    <div>
                        <h6 class="mb-0">{{ $course->formateur->user->name }}</h6>
                        <p class="text-muted mb-0">
                            {{ $course->formateur->user->profile->occupation ?? 'Formateur' }}
                        </p>
                    </div>
                </div>
                
                
                <p class="mb-4">{{ $course->description }}</p>
                
                <div class="price-tag d-inline-flex align-items-center gap-3 mb-4">
                    <div>
                        <span class="current-price">{{ $course->price }} DH</span>
                        @if($course->old_price)
                            <div class="d-flex align-items-center">
                                <span class="old-price">{{ $course->old_price }} DH</span>
                                @php
                                    $discount = round((($course->old_price - $course->price) / $course->old_price) * 100);
                                @endphp
                                <span class="discount-badge ms-2">{{ $discount }}% DE RÉDUCTION</span>
                            </div>
                        @endif
                    </div>
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
                                 @if (Auth::check())
                                        <!-- Bouton dynamique -->
                                @if($isInscrit)
                                    <form action="{{ route('student.panier.ajouter', $course->id) }}" method="POST">
                                        @csrf
                                        {{-- <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-cart-plus me-1"></i> Ajouter au panier
                                        </button> --}}
                                        <button  class="btn btn-success w-100"> Voir le cours </button>
                                    
                                    </form>
                                
                                @else
                                    <form action="{{ route('student.panier.ajouter', $course->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100"> Ajouter au panier</button>
                                    </form>
                                @endif
                            
                            @else
                               
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    Ajouter au panier
                                </button>
                            @endif
                </div>
            </div>
            
            <div class="col-lg-4">
                @if($course->image)
                    <img src="{{ asset('storage/' . $course->image) }}" 
                         alt="{{ $course->titre }}" 
                         class="img-fluid course-image w-100">
                @endif
                
                @if($course->video_intro)
                    <div class="video-container">
                        <div class="ratio ratio-16x9">
                            <video controls>
                                <source src="{{ asset('storage/' . $course->video_intro) }}" type="video/mp4">
                                Votre navigateur ne supporte pas la balise vidéo.
                            </video>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Colonne des détails du cours -->
        <div class="col-lg-8">
          
            
            <!-- Section formateur -->
            <div class="course-section">
                <h3 class="section-title">
                    <i class="fas fa-chalkboard-teacher"></i> À propos du formateur
                </h3>
                
                <div class="row">
                    <div class="col-md-3 text-center">
                        @if($course->formateur->user->profile->avatar)
                            <img src="{{ asset('storage/' . $course->formateur->user->profile->avatar) }}" 
                                 class="img-fluid rounded-circle mb-3" 
                                 style="width: 120px; height: 120px; object-fit: cover;"
                                 alt="{{ $course->formateur->user->name }}">
                        @else
                            <div class="rounded-circle bg-secondary mb-3 d-flex align-items-center justify-content-center mx-auto" 
                                 style="width: 120px; height: 120px;">
                                <i class="fas fa-user fa-3x text-white"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h4>{{ $course->formateur->user->name }}</h4>
                        <p class="text-muted">{{ $course->formateur->user->profile->occupation ?? 'Formateur' }}</p>
                        
                        @if($course->formateur->user->profile->bio)
                            <p>{{ $course->formateur->user->profile->bio }}</p>
                        @else
                            <p class="text-muted">Aucune biographie disponible pour ce formateur.</p>
                        @endif
                        
                        <div class="mt-3">
                            @if($course->formateur->user->profile->website)
                                <a href="{{ $course->formateur->user->profile->website }}" class="social-link" target="_blank">
                                    <i class="fas fa-globe"></i>
                                </a>
                            @endif
                            
                            @if($course->formateur->user->profile->facebook_profile)
                                <a href="{{ $course->formateur->user->profile->facebook_profile }}" class="social-link" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif
                            
                            @if($course->formateur->user->email)
                                <a href="mailto:{{ $course->formateur->user->email }}" class="social-link">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Colonne latérale -->
        <div class="col-lg-4">
            <!-- Statistiques du cours -->
            <div class="course-section">
                <h3 class="section-title">
                    <i class="fas fa-chart-bar"></i> Détails du cours
                </h3>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Modules de contenu</div>
                        <h5 class="stat-value">{{ $course->contents_count }}</h5>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Créé le</div>
                        <h5 class="stat-value">{{ \Carbon\Carbon::parse($course->created_at)->format('d M Y') }}</h5>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Catégorie</div>
                        <h5 class="stat-value">{{ $course->category->nom }}</h5>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Dernière mise à jour</div>
                        <h5 class="stat-value">{{ \Carbon\Carbon::parse($course->updated_at)->format('d M Y') }}</h5>
                    </div>
                </div>
            </div>
            
           
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    // Hide alert after 3 seconds
    setTimeout(() => {
      const alert = document.getElementById('alert-message');
      if (alert) {
          alert.style.opacity = '0';
          setTimeout(() => alert.remove(), 300); // remove after fade
      }
  }, 3000);
</script>
@endpush