@extends('layouts.teach')

@section('content')
<div class="container">
    <h2>選擇課程以查看其作業</h2>

    <form method="GET" action="{{ route('course.assignments') }}" class="mb-4">
        <div class="input-group">
            <select name="cid" class="form-select" onchange="this.form.submit()">
                <option value="">請選擇課程</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->cid }}" {{ $selectedCid == $course->cid ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @if ($selectedCid)
        <h4>成績名稱: </h4>

        @if (count($assignments) > 0)
            <ul class="list-group">
                @foreach ($assignments as $assignment)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $assignment->title }}
                        <a href="{{ route('assignment.grades', ['cid' => $selectedCid, 'assid' => $assignment->assid]) }}" class="btn btn-sm btn-primary">
                            查看成績
                        </a>
                    </li>
                @endforeach

            </ul>
        @else
            <p>此課程尚無作業。</p>
        @endif
    @endif
</div>
@endsection
