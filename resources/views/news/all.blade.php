@extends('layouts.app')

@section('content')
    <div class="all-news-container">
        @include('news.index', ['hideMoreNewsHref' => true])
    </div>
@endsection
