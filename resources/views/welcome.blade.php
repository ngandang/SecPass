<h1>Chào mừng {{ __('bạn')}} đến với SecPASS.</h1>

<p>
@guest
    Nhấn vào <a href="login">đây</a> để đăng nhập
@else
    Nhấn vào <a href="dashboard">đây</a> để vào dashboard
@endguest
</p>