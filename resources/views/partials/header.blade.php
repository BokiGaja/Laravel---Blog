<header class="navbar navbar-dark bg-dark d-flex justify-content-between">
    <div>
        <img src="https://www.vivifyideas.com/images/logo-cover.jpg" style="height: 80px; width: 200px; border-radius: 20%" alt="">
        @auth
            <a class="btn btn-sm btn-outline-info btn-lg" href="{{ route('posts-create') }}">Create Post</a>
            <a class="btn btn-sm btn-outline-info btn-lg" href="{{ route('my-posts') }}">My posts</a>
            @if(auth()->user()->email == 'admin@admin.com')
                <a class="btn btn-sm btn-outline-info btn-lg" href="{{ route('users-edit') }}">Users</a>
                <a class="btn btn-sm btn-outline-info btn-lg" href="telescope">Telescope</a>
            @endif
        @endauth
    </div>
    <div style="margin-left: 100px">
        <a href="/" class="btn btn-info btn-lg">Home</a>
        <a href="/posts" class="btn btn-info btn-lg">Posts</a>
    </div>
    <div class="d-flex justify-content-end align-items-center">
        @auth
            <a class="btn btn-sm btn-outline-info btn-lg" href="{{ route('logout') }}">{{ auth()->user()->name }} (Logout)</a>
        @endauth
        @guest
            <a class="btn btn-sm btn-outline-info btn-lg" href="{{ route('show-register') }}">Sign up</a>
            <a class="btn btn-sm btn-outline-info btn-lg" href="{{ route('show-login') }}">Login</a>
        @endguest
    </div>
</header>
