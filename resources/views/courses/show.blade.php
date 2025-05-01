@extends('layouts.app')

@section('content')
    <h1>{{ $course->name }}</h1>
    <p><strong>授課教師：</strong>{{ $course->teacher->name ?? '未知' }}</p>
    <div class="mt-4">
        <p>{{ $course->description }}</p>
    </div>
@endsection
