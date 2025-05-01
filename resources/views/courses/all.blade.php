@extends('layouts.app')

@section('content')
<div class="row">
    <p style="font-weight: bold; font-size: 2rem; margin: 0;">所有課程</p>
    <div class="mb-4">
        <a href="{{ url('/') }}" style="text-decoration: none; color: #666;">&laquo;&laquo; 返回首頁</a>
    </div>

    @foreach ($courses as $course)
        @include('courses.course_card', ['course' => $course])
    @endforeach
</div>
@endsection
