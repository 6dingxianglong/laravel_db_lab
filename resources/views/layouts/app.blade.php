<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>中山網路大學</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1; /* 撐滿剩下空間 */
        }

        footer {
            background-color: #222;
            color: #fff;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    @include('app.header')
    @include('app.navbar')

    <main class="container mt-4">
        @yield('content')
    </main>

    <footer>
        @include('app.footer')
    </footer>
</body>
</html>
