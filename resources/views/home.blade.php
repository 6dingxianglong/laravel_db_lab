@extends('layouts.app')

@section('content')
    {{-- 顯示最新消息 --}}
    <div class="mb-5">
        @include('news.index')
    </div>

    {{-- 顯示課程 tabs --}}
    <div class="mb-2">
        @include('courses.course_tabs')
    </div>

    {{-- 顯示課程卡片 --}}
    <div class="row">
        @include('courses.index')
    </div>

    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('courses.all') }}" class="text-decoration-none text-dark fs-4">查看更多 »</a>
    </div>    

@endsection
