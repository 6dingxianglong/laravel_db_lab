<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>中山網路大學</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('partials.header')
    @include('partials.navbar')

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>