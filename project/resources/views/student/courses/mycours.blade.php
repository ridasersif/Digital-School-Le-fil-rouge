

@extends('layouts.frontend')
@section('title', 'My Courses')
@push('style')
    <style>
        .course-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            position: relative;
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .course-image {
            height: 200px;
            object-fit: cover;
        }
        .old-price {
            text-decoration: line-through;
            color: #6c757d;
            font-size: 14px;
        }
        .instructor-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .instructor-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }
        .course-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }
        .content-count {
            background-color: #f8f9fa;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
        }
        .section-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: #0d6efd;
        }
        .quick-view {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(255,255,255,0.8);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .quick-view:hover {
            background-color: #fff;
        }
        .modal-header {
            background-color: #f8f9fa;
        }
        .stats-box {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .stats-box h5 {
            margin-bottom: 15px;
            color: #0d6efd;
            font-size: 16px;
        }
        .stat-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .stat-item i {
            margin-right: 10px;
            color: #0d6efd;
        }
        .course-description {
            margin-bottom: 20px;
        }
        .modal-instructor {
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }
        .modal-instructor-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }
        * Dark mode specific adjustments */
        [data-bs-theme="dark"] .course-card {
            background-color: #212529;
            border-color: #343a40;
        }
        
        [data-bs-theme="dark"] .card {
            background-color: #212529;
            border-color: #343a40;
        }
        
        [data-bs-theme="dark"] .quick-view {
            background-color: rgba(33, 37, 41, 0.8);
            color: #f8f9fa;
        }
        
        [data-bs-theme="dark"] .quick-view:hover {
            background-color: #343a40;
        }
        
        [data-bs-theme="dark"] .content-count {
            background-color: #343a40;
            color: #e9ecef;
        }
        
        [data-bs-theme="dark"] .modal-content {
            background-color: #212529;
            border-color: #343a40;
        }
        
        [data-bs-theme="dark"] .modal-header,
        [data-bs-theme="dark"] .modal-footer {
            background-color: #1a1d20;
            border-color: #343a40;
        }
        
        [data-bs-theme="dark"] .stats-box,
        [data-bs-theme="dark"] .modal-instructor {
            background-color: #1a1d20;
            color: #e9ecef;
        }
        
        [data-bs-theme="dark"] .list-group-item {
            background-color: #212529;
            border-color: #343a40;
            color: #e9ecef;
        }
        
        [data-bs-theme="dark"] .text-muted {
            color: #adb5bd !important;
        }
        
        [data-bs-theme="dark"] .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
    </style>
@endpush


@section('contents')
    <div class="container py-5">
        <h1 class="section-title">My Courses</h1>
        
        @if($courses->count() > 0)
            <div class="row g-4">
                @foreach($courses as $course)
                    <div class="col-md-6 col-lg-4">
                        <div class="card course-card shadow-sm">
                            <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top course-image" alt="{{ $course->titre }}">
                            
                            <!-- Quick View Button -->
                            <div class="quick-view" data-bs-toggle="modal" data-bs-target="#courseModal{{ $course->id }}">
                                <i class="bi bi-eye"></i>
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <div class="instructor-info">
                                    @if($course->formateur->user->profile && $course->formateur->user->profile->avatar)
                                        <img src="{{ asset('storage/' . $course->formateur->user->profile->avatar) }}" class="instructor-avatar" alt="Instructor">
                                    @else
                                        <div class="instructor-avatar bg-secondary d-flex align-items-center justify-content-center text-white">
                                            {{ substr($course->formateur->user->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <span>{{ $course->formateur->user->name }}</span>
                                </div>
                                
                                <h5 class="card-title">{{ $course->titre }}</h5>
                                <p class="card-text text-truncate">{{ $course->description }}</p>
                                
                                <div class="course-meta mt-auto">
                
                                    <span class="badge bg-primary">
                                        <iconify-icon icon="{{ $course->category->icon }}"></iconify-icon>

                                        {{ $course->category->nom }}
                                    </span>
                                    <span class="content-count">
                                        <i class="bi bi-collection"></i> {{ $course->contents_count }} lessons
                                    </span>
                                </div>
                                
                                <a href="{{route('student.myCourses.show',$course->id)}}" class="btn btn-primary mt-3">Commencer à apprendre</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Course Modal -->
                    <div class="modal fade" id="courseModal{{ $course->id }}" tabindex="-1" aria-labelledby="courseModalLabel{{ $course->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="courseModalLabel{{ $course->id }}">{{ $course->titre }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ asset('storage/' . $course->image) }}" class="img-fluid rounded mb-3" alt="{{ $course->titre }}">
                                            
                                            <div class="stats-box">
                                                <h5><i class="bi bi-info-circle"></i> Course Statistics</h5>
                                                
                                                @php
                                                    $videoCount = $course->contents->where('type', 'video')->count();
                                                    $pdfCount = $course->contents->where('type', 'pdf')->count();
                                                    $totalPages = $course->contents->sum('nombre_pages');
                                                    $totalDuration = $course->contents->sum('duree');
                                                @endphp
                                                
                                                <div class="stat-item">
                                                    <i class="bi bi-camera-video"></i>
                                                    <span>{{ $videoCount }} Videos</span>
                                                </div>
                                                <div class="stat-item">
                                                    <i class="bi bi-file-pdf"></i>
                                                    <span>{{ $pdfCount }} PDFs</span>
                                                </div>
                                                <div class="stat-item">
                                                    <i class="bi bi-file-text"></i>
                                                    <span>{{ $totalPages ?: 0 }} Pages</span>
                                                </div>
                                                <div class="stat-item">
                                                    <i class="bi bi-clock"></i>
                                                    <span>{{ $totalDuration ?: 0 }} Minutes</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-8">
                                            <div class="course-description">
                                                <h5>About This Course</h5>
                                                <p>{{ $course->description }}</p>
                                            </div>
                                            
                                            <div class="modal-instructor">
                                                @if($course->formateur->user->profile && $course->formateur->user->profile->avatar)
                                                    <img src="{{ asset('storage/' . $course->formateur->user->profile->avatar) }}" class="modal-instructor-avatar" alt="Instructor">
                                                @else
                                                    <div class="modal-instructor-avatar bg-secondary d-flex align-items-center justify-content-center text-white">
                                                        {{ substr($course->formateur->user->name, 0, 1) }}
                                                    </div>
                                                @endif
                                                <div>
                                                    <h5 class="mb-1">{{ $course->formateur->user->name }}</h5>
                                                    <p class="mb-0 text-muted">{{ $course->formateur->user->profile->occupation ?? 'Instructor' }}</p>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-4">
                                                <h5>Course Content</h5>
                                                <div class="list-group">
                                                    @foreach($course->contents as $content)
                                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                                            <div>
                                                                @if($content->type == 'video')
                                                                    <i class="bi bi-camera-video me-2"></i>
                                                                @elseif($content->type == 'pdf')
                                                                    <i class="bi bi-file-pdf me-2"></i>
                                                                @else
                                                                    <i class="bi bi-file-text me-2"></i>
                                                                @endif
                                                                {{ $content->titre }}
                                                            </div>
                                                            <span class="badge bg-primary rounded-pill">
                                                                @if($content->duree)
                                                                    {{ $content->duree }} min
                                                                @elseif($content->nombre_pages)
                                                                    {{ $content->nombre_pages }} pages
                                                                @else
                                                                    -
                                                                @endif
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{route('student.myCourses.show',$course->id)}}" class="btn btn-primary">Commencer à apprendre</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $courses->links() }}
            </div>
        @else
            <div class="alert alert-info">
                <p class="mb-0">You haven't enrolled in any courses yet.</p>
            </div>
        @endif
    </div>
@endsection

   