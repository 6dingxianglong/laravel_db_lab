@extends('layouts.learn')

@section('content')
<h4 class="mt-5">成績分布圖</h4>
<canvas id="scoreChart" width="400" height="200"></canvas>

@if ($myScore !== null)
    <h5 class="mt-3">
        <strong>你的成績：</strong> {{ $myScore }} 分
    </h5>
@else
    <h5 class="mt-3">
        <strong>你的成績：</strong> 尚未評分
    </h5>
@endif

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const myScore = {{ $myScore ?? 'null' }};
let myScoreIndex = myScore !== null ? Math.min(Math.floor(myScore / 10), 9) : null;

const ctx = document.getElementById('scoreChart').getContext('2d');
const scoreChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            '0-9', '10-19', '20-29', '30-39', '40-49', 
            '50-59', '60-69', '70-79', '80-89', '90-100'
        ],
        datasets: [{
            data: @json($scoreRanges),
            backgroundColor: function(context) {
                const index = context.dataIndex;
                if (index === myScoreIndex) {
                    return 'rgba(255, 99, 132, 0.7)'; // 個人成績區間：紅色
                }
                return 'rgba(54, 162, 235, 0.6)'; // 其他：藍色
            },
            borderColor: function(context) {
                const index = context.dataIndex;
                return (index === myScoreIndex) ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)';
            },
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false //  不顯示 label 圖例
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                stepSize: 1
            }
        }
    }
});
</script>

@endsection
