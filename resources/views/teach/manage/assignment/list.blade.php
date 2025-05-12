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
                    <td>
                        <a href="{{ route('teach.ass.edit', ['assid' => $assignment->assid]) }}" class="btn btn-sm btn-warning">編輯</a>
                        <form action="{{ route('teach.ass.delete', ['assid' => $assignment->assid]) }}" method="POST" style="display:inline;">
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
