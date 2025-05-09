@extends('layouts.teach')
@section('content')

<div class="container">
    <form action="{{ route('teach.manage.announcement.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="course-select" class="form-label">選擇課程：</label>
            <select id="course-select" name="cid" class="form-select" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->cid }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">公告標題：</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">公告內容：</label>
            <textarea id="content" name="content" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">儲存公告</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">返回</a>
    </form>

    @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
@endif

</div>

@endsection
