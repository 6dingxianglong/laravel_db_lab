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

    <h4 class="mt-5">成績分布圖</h4>
    <canvas id="scoreChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('scoreChart').getContext('2d');
    const scoreChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                '0-9', '10-19', '20-29', '30-39', '40-49', 
                '50-59', '60-69', '70-79', '80-89', '90-100'
            ],
            datasets: [{
                label: '人數',
                data: @json($scoreRanges),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true, stepSize: 1 }
            }
        }
    });
</script>

@endsection
