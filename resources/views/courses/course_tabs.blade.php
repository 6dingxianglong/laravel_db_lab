<div class="mb-2">
    <ul class="nav nav-tabs mb-3" id="courseTabs">
        <li class="nav-item">
            <a class="nav-link {{ $sort !== 'popular' ? 'active' : '' }}" href="{{ route('home') }}?sort=latest">最新課程</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $sort === 'popular' ? 'active' : '' }}" href="{{ route('home') }}?sort=popular">熱門課程</a>
        </li>
    </ul>
</div>