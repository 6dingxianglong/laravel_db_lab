@extends('layouts.learn')

@section('content')
<div class="container">
    <h2>{{ $course->name }} - 公告列表</h2>
    
    <a href="{{ route('learn.index') }}" class="btn btn-secondary mb-3">返回</a>

    <table class="table">
        <thead>
            <tr>
                <th>標題</th>
                <th>內容</th>
                <th>發佈時間</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($announcements as $announcement)
                <tr>
                    <td>{{ $announcement->title }}</td>
                    <td>{{ $announcement->content }}</td>
                    <td>{{ $announcement->timestamp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
