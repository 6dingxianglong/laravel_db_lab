@extends('layouts.learn')

@section('content')
<div class="container">
    
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <h2>{{ $course->name }} - 作業列表</h2>
    
    <a href="{{ route('learn.index') }}" class="btn btn-secondary mb-3">返回</a>

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
                        @if (\Carbon\Carbon::now()->lessThanOrEqualTo(\Carbon\Carbon::parse($assignment->deadline)))
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#submitModal{{ $assignment->assid }}">
                                提交作業
                            </button>
                        @else
                            <span class="text-danger">關閉作答</span>
                        @endif
                    </td>
                   
                </tr>

                <!-- Modal -->
                @include('learn.manage.assignment.modal', ['assignment' => $assignment])

            @endforeach
        </tbody>
    </table>
</div>
@endsection
