@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('teach.ass.update', ['assid' => $assignment->assid]) }}" method="POST">
        @csrf
        @method('PUT') <!-- Laravel 用於標示這是 PUT 請求 -->

        <input type="hidden" name="cid" value="{{ $assignment->cid }}">

        <div class="mb-3">
            <label class="form-label">作業標題：</label>
            <input type="text" name="title" class="form-control" value="{{ $assignment->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">作業內容：</label>
            <textarea name="description" class="form-control" rows="5" required>{{ $assignment->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="deadline" class="form-label">截止日期與時間：</label>
            <input type="datetime-local" id="deadline" name="deadline" class="form-control"
            value="{{ \Carbon\Carbon::parse($assignment->deadline)->format('Y-m-d\TH:i') }}" required>
        </div>   

        <button type="submit" class="btn btn-success">更新作業</button>
        <a href="{{ route('teach.index')}}" class="btn btn-secondary">返回</a>
    </form>

    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif
</div>
@endsection
