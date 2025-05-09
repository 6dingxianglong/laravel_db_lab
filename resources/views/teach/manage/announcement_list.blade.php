@extends('layouts.teach')

@section('content')
<div class="container">
    <h2>{{ $course->name }} - 公告列表</h2>
    
    <a href="{{ route('teach.manage.announcement.add') }}" class="btn btn-primary mb-3">新增公告</a>
    <a href="{{ route('teach.index') }}" class="btn btn-secondary mb-3">返回</a>

    <table class="table">
        <thead>
            <tr>
                <th>標題</th>
                <th>內容</th>
                <th>發佈時間</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($announcements as $announcement)
                <tr>
                    <td>{{ $announcement->title }}</td>
                    <td>{{ $announcement->content }}</td>
                    <td>{{ $announcement->timestamp }}</td>
                    <td>
                        <a href="{{ route('teach.manage.announcement.edit', ['annid' => $announcement->annid]) }}" class="btn btn-sm btn-warning">編輯</a>
                        <form action="{{ route('teach.manage.announcement.delete', ['annid' => $announcement->annid]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('確定要刪除嗎？')">刪除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
