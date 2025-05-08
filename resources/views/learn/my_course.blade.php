<style>
    .course-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .course-title {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
        font-weight: bold;
    }
    
    .table-responsive {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        margin-bottom: 0;
    }
    
    .table th {
        background-color: #fb782d;
        color: white;
        padding: 15px;
        font-size: 16px;
        text-align: center;
        vertical-align: middle;
    }
    
    .table td {
        padding: 12px 15px;
        text-align: center;
        vertical-align: middle;
        border-bottom: 1px solid #eee;
    }
    
    .table tbody tr:hover {
        background-color: #f9f9f9;
    }
    
    .action-link {
        display: inline-block;
        padding: 6px 12px;
        background-color: #fbc02d;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
    }
    
    .action-link:hover {
        background-color: #f9a825;
        color: white;
    }
</style>

<div class="course-container">
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>課程名稱</th>
                    <th>課程狀態</th>
                    <th>開始上課</th>
                    <th>截止上課</th>
                    <th>學員人數</th>
                    <th>公告</th>
                    <th>作業</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enrollments as $enrollment)
                    <tr>
                        <td>
                            <strong>{{ $enrollment->course->name }}</strong>
                        </td>
                        <td><span class="badge bg-success">開課</span></td>
                        <td>即日起</td>
                        <td>無限期</td>
                        <td>{{ $enrollment->course->enrollments_count }} 人</td>
                        <td><a href="#" class="action-link">查看</a></td>
                        <td><a href="#" class="action-link">繳交</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
