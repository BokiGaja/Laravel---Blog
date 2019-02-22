<nav class="col-md-2 d-none d-md-block bg-dark sidebar">
    <div class="sidebar-sticky">
        <h3 style="color: white; text-align: center">Tags</h3>
        <ul class="nav flex-column">
            @foreach($tags as $tag)
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route(('tags-posts'), ['tag' => $tag->id ]) }}" style="color: white">{{ $tag->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>