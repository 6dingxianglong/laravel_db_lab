@extends('layouts.teach')

@section('content')
<div class="container">
    <h2>作業：{{ $assignment->title }} 的提交列表</h2>
    <a href="{{ route('teach.ass.list', ['cid' => $cid]) }}" class="btn btn-secondary mb-3">返回列表</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>學生編號</th>
                <th>提交時間</th>
                <th>檔案</th>
                <th>分數</th>
                <th>回饋</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($submissions as $submission)
                <tr>
                    <td>{{ $submission->sid }}</td>
                    <td>{{ $submission->submit_date }}</td>
                    <td>
                        <a href="{{ route('submission.download', ['filename' => basename($submission->url)]) }}" target="_blank">下載</a>
                    </td>
                    <td>{{ $submission->score ?? '尚未評分' }}</td>
                    <td>{{ $submission->feedback ?? '無' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">尚無學生提交此作業。</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
