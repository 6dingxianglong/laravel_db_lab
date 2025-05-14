@extends('layouts.teach')

@section('content')
<div class="container">

    <h1>TA 課程列表</h1>
    <div class="mb-2">
    @include('teach.my_course')
    </div>


    @if ($courses->isEmpty())
        <p>目前沒有任何課程。</p>
    @endif
</div>
@endsection

