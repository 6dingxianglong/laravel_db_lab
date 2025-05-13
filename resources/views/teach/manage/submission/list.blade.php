@extends('layouts.teach')

@section('content')
<div class="container">
    <h2>作業：{{ $assignment->title }} 的提交列表</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="關閉"></button>
        </div>
    @endif

    <a href="{{ route('teach.ass.list', ['cid' => $cid]) }}" class="btn btn-secondary mb-3">返回列表</a>

    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>學生編號</th>
                <th>學生姓名</th>
                <th>提交時間</th>
                <th>檔案</th>
                <th>分數</th>
                <th>回饋</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($submissions as $submission)
                <tr>
                    <td>{{ $submission->sid }}</td>
                    <td>{{ $submission->student->name ?? '（未知）' }}</td>
                    <td>{{ $submission->submit_date }}</td>
                    <td>
                        <a href="{{ route('submission.download', ['filename' => basename($submission->url)]) }}" target="_blank" class="btn btn-sm btn-info">下載</a>
                    </td>
                    <td colspan="2">
                        <form action="{{ route('submission.update', ['sid' => $submission->sid, 'assid' => $submission->assid]) }}" method="POST" class="row g-2 align-items-center">
                            @csrf
                            <div class="col-auto">
                                <input type="number" name="score" value="{{ $submission->score }}" class="form-control form-control-sm" placeholder="分數" style="width: 80px;">
                            </div>
                            <div class="col">
                                <input type="text" name="feedback" value="{{ $submission->feedback }}" class="form-control form-control-sm" placeholder="回饋">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-sm btn-primary">儲存</button>
                            </div>
                        </form>
                    </td>

                    <td>
                        <form action="{{ route('submission.email') }}" method="POST" style="display:inline;" id="emailForm{{ $submission->sid }}">
                            @csrf
                            <input type="hidden" name="sid" value="{{ $submission->sid }}">
                            <input type="hidden" name="title" value="{{ $assignment->title }}">
                            <input type="hidden" name="score" value="{{ $submission->score }}">
                            <input type="hidden" name="feedback" value="{{ $submission->feedback }}">
                            <button type="submit" class="btn btn-sm btn-warning" id="emailButton{{ $submission->sid }}">寄信</button>
                        </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">尚無學生提交此作業。</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
