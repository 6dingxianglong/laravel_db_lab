<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<nav class="navbar" style="background-color: #1d53b8;"> 
    <div class="container px-0 d-flex align-items-center justify-content-between">
        <a href="/courses/all" class="btn btn-outline-light me-4 px-3 py-1">課程總覽</a>

        <form class="d-flex flex-grow-1 me-2" role="search">
            <input class="form-control me-1" type="search" placeholder="課程搜尋" aria-label="Search">
            <button class="btn btn-outline-light px-3 py-1 me-4" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>

        @include('auth.auth')
    </div>
</nav>