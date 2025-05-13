@extends('layouts.teach')
@section('content')

<div class="container">
    <form action="{{ route('teach.ass.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="course-select" class="form-label">選擇課程：</label>
            <select id="course-select" name="cid" class="form-select" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->cid }}"
                        {{ session('selected_cid') == $course->cid ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">作業標題：</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">作業內容：</label>
            <textarea id="description" name="description" class="form-control" rows="5" required></textarea>
        </div>        

        <div class="mb-3">
            <label for="deadline" class="form-label">截止日期與時間：</label>
            <input type="datetime-local" id="deadline" name="deadline" class="form-control" required>
        </div>        

        <button type="submit" class="btn btn-primary">儲存作業</button>
        <a href="{{ route('teach.index') }}" class="btn btn-secondary">返回</a>
    </form>

    @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
@endif

</div>

@endsection
