<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>中山網路大學</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
  
        .main-content {
            padding: 20px;
            padding-top: 76px;
        }
        
        .header {
            position: fixed;
            width: 100%;
            z-index: 200;
        }
        
        @media (max-width: 768px) {
            
            .main-content {
                margin-left: 0;
                padding-top: 20px;
            }
            
            .header {
                position: static;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        @include('teach.header')
    </header>

    <div class="container mt-4">
        
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>