

<nav class="auth navbar"> 
    {{-- 若教師已登入 --}}
    @auth('teacher')
    <a href="{{ route('teach.index') }}" class="text-white me-3">歡迎，{{ Auth::guard('teacher')->user()->name }}</a>
    <a href="{{ route('logout') }}" class="btn btn-danger px-3 py-1">登出</a>

    {{-- 若學生已登入 --}}
    @elseif(Auth::guard('student')->check())
    <a href="{{ route('learn.index') }}" class="text-white me-3">歡迎，{{ Auth::guard('student')->user()->name }}</a>
    <a href="{{ route('logout') }}" class="btn btn-danger px-3 py-1">登出</a>

    {{-- 未登入 --}}
    @else
    <a href="{{ route('login') }}" class="btn btn-success px-3 py-1">使用者登入</a>
    @endauth
</nav>
