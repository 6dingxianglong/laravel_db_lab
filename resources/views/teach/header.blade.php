<nav class="navbar bg-white border-bottom py-0">
    <div class="container d-flex align-items-center justify-content-between">

        <a class="navbar-brand m-0" href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Course Image" style="height: 50px;">
        </a>

        <div class="d-flex align-items-center">
            <a href="#" class="btn btn-outline-secondary me-2">人員管理</a>
            <a href="{{ route('teach.manage.announcement.add') }}" class="btn btn-outline-secondary me-2">新增公告</a>
            <a href="#" class="btn btn-outline-secondary me-2">新增作業</a>
            <a href="#" class="btn btn-outline-secondary me-2">成績管理</a>

            <p class="m-0 px-3 border-start border-end"><i class="bi bi-person-fill me-1"></i>{{ Auth::guard('teacher')->user()->name }}</p>

            <a href="{{ route('logout') }}" class="btn btn-danger px-3 py-1 ms-2">登出</a>
        </div>

    </div>
</nav>
