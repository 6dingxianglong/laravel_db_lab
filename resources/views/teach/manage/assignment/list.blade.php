@extends('layouts.teach')

@section('content')
<div class="container">
    <h2>{{ $course->name }} - 作業列表</h2>
    
    <a href="{{ route('teach.index') }}" class="btn btn-secondary mb-3">返回</a>

    <table class="table">
        <thead>
            <tr>
                <th>標題</th>
                <th>內容</th>
                <th>截止日期</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assignments as $assignment)
                <tr>
                    <td>{{ $assignment->title }}</td>
                    <td>{{ $assignment->description }}</td>
                    <td>{{ $assignment->deadline }}</td>
                   
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
