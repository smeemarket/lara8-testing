@if (Session::has('checkError'))
    <p style="color: red">{{ Session::get('checkError') }}</p>
@endif

<h1>Admin</h1>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <input type="submit" value="Logout">
</form>
