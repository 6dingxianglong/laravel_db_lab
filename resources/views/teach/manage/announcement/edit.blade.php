@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('teach.ann.update', ['annid' => $announcement->annid]) }}" method="POST">
        @csrf
        @method('PUT') <!-- Laravel 用於標示這是 PUT 請求 -->

        <div class="mb-3">
            <label class="form-label">公告標題：</label>
            <input type="text" name="title" class="form-control" value="{{ $announcement->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">公告內容：</label>
            <textarea name="content" class="form-control" rows="5" required>{{ $announcement->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">更新公告</button>
        <a href="{{ route('teach.index')}}" class="btn btn-secondary">返回</a>
    </form>

    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif
</div>
@endsection
