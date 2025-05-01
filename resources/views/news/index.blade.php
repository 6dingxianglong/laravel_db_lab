<div class="news-container" style="max-height: 400px; overflow: hidden;"> 
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
        <p style="font-weight: bold; font-size: 2rem; margin: 0;">最新消息</p>
        <a href="{{ route('news.all') }}" style="text-decoration: none; color: #666;">更多消息 »</a>
    </div>
    <hr style="border-bottom: solid 1px #aaa; margin-top: 0; margin-bottom: 15px;">

    <div style="display: flex; flex-wrap: wrap; justify-content: space-between;">
        @foreach($news_items as $item)
            <div style="width: 48%; margin-bottom: 15px;">
                <a href="{{ $item['link'] }}" style="text-decoration: none; color: black; display: block; padding-bottom: 10px; border-bottom: solid 1px #aaa;">
                    <div>{{ $item['date'] }}</div>  
                    <div>{{ $item['title'] }}</div>
                </a>
            </div>
        @endforeach
    </div>
</div>
