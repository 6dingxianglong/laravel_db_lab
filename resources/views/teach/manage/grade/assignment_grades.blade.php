@extends('layouts.teach')

@section('content')
<div class="container">
    <h2>作業：{{ $assignment->title }} — 全班成績</h2>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="關閉"></button>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>學號</th>
                <th>姓名</th>
                <th>分數</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <form action="{{ route('grade.updateOrCreate') }}" method="POST" class="d-flex">
                        @csrf
                        <td>{{ $student->sid }}</td>
                        <td>{{ $student->name }}</td>
                        <td>
                            <input type="number" name="score" value="{{ $grades[$student->sid]->score ?? 0 }}" class="form-control" min="0" max="100">
                        </td>
                        <td>
                            <input type="hidden" name="sid" value="{{ $student->sid }}">
                            <input type="hidden" name="cid" value="{{ $cid }}">
                            <input type="hidden" name="assid" value="{{ $assignment->assid }}">
                            <button type="submit" class="btn btn-primary btn-sm">修改</button>
                        </td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
