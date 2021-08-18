<h1>Chào mừng bạn đến với trang quản trị</h1>
@if(auth()->user())
    <a href="{{ route("logout") }}">Logout</a>
@endif
