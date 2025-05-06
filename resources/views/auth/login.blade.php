@extends('layouts.app') 
@section('content')
<div class="container mt-5" style="max-width: 400px;">
    <h2 class="mb-4">使用者登入</h2>
    
    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="account" class="form-label">帳號</label>
            <input type="text" class="form-control" id="account" name="account" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">密碼</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-4">登入</button>
    </form>

    <div class="alert alert-info">
        <p>
            因應資安考量，帳號欄位由明碼調整為部分隱碼，故不適用瀏覽器記憶帳密功能。
            如有登入異常或欲使用瀏覽器記憶帳密登入功能，請參閱以下說明。
        </p>
        <ol>
            <li>
                <h5>
                登入異常排除：
                </h5>
                <p>
                    • 建議完整清除瀏覽器的瀏覽紀錄、cookies、登入帳密等資料後再行登入。<br>
                    • 若欲使用瀏覽器記憶密碼功能，可將登入帳號欄位右側的小眼睛圖示打開，讓瀏覽器取得正確帳密後存入即可。操作方式可參考 [首頁]-[最新消息]。
                </p>
            </li>
            <li> 
                <h5>
                登入對象：
                </h5>
                <p>
                    • 本校教職員生。<br>
                    • 校際選課學生。<BR>
                    • 學分班學生。<br>
                </p>
                
            </li>
        </ol>
    </div>
   
</div>
@endsection
