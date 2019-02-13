<header class="navbar navbar-dark bg-dark d-flex justify-content-between">
    <div>
        <img src="https://www.vivifyideas.com/images/logo-cover.jpg" style="height: 80px; width: 200px; border-radius: 20%" alt="">
        @auth
        <a class="btn btn-sm btn-outline-info btn-lg" href="/posts/create">Create Post</a>
        @endauth
    </div>
    <div style="margin-left: 100px">
        <a href="/" class="btn btn-info btn-lg">Home</a>
        <a href="/posts" class="btn btn-info btn-lg">Posts</a>
    </div>
    <div class="d-flex justify-content-end align-items-center">
        <nav class="navbar navbar-dark bg-dark">
            {{-- Search bar --}}
            {{--<form class="form-inline">--}}
                {{--<div class="form-group has-search">--}}
                    {{--<input type="text" class="form-control search-query" placeholder="Search">--}}
                    {{--<a class="btn btn-info" style="color: white" href="#"><span class="fa fa-search"></span></a>--}}
                {{--</div>--}}
            {{--</form>--}}
        </nav>
        @auth
            <a class="btn btn-sm btn-outline-info btn-lg" href="{{ route('logout') }}">{{ auth()->user()->name }} (Logout)</a>
        @endauth
        @guest
            <a class="btn btn-sm btn-outline-info btn-lg" href="/register">Sign up</a>
            <a class="btn btn-sm btn-outline-info btn-lg" href="{{ route('show-login') }}">Login</a>
        @endguest
    </div>
</header>
