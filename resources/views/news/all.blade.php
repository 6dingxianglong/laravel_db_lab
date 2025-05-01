@extends('layouts.app')

@section('content')
    <div class="news-container">
        <p style="font-weight: bold; font-size: 2rem; margin: 0;">所有新聞</p>
        <a href="{{ url('/') }}" style="text-decoration: none; color: #666;"><<返回首頁</a>

        <hr>
            @foreach($news_items as $item)
                <div style="width: 48%; margin-bottom: 15px;">
                    <a href="{{ $item['link'] }}" style="text-decoration: none; color: black; display: block; padding-bottom: 10px; border-bottom: solid 1px #aaa;">
                        <div>{{ $item['date'] }}</div>  
                        <div>{{ $item['title'] }}</div>
                    </a>
                </div>
            @endforeach
    </div>
@endsection
