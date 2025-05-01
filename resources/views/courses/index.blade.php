@foreach ($courses as $course)
<div class="col-md-3 mb-4">
    <a href="{{ url('courses/' . $course->cid) }}" class="text-decoration-none text-dark">
        <div class="card h-100 d-flex flex-column">
            <img src="{{ asset('images/course.jpeg') }}" alt="Course Image" class="card-img-top">

            <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title fw-bold mb-3 text-truncate" title="{{ $course->name }}">
                    {{ $course->name }}
                </h5>
                
                <div class="mt-auto">
                    <p class="text-muted mb-1">
                        <i class="bi bi-person-fill me-1"></i>{{ $course->teacher->name ?? '未知教師' }}
                    </p>
                    <hr class="my-2">
                    <p class="text-muted mb-0">課程代碼：{{ $course->cid }}</p>
                </div>
            </div>
        </div>
    </a>
</div>
@endforeach
