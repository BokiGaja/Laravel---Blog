@extends('layouts.master')

@section('title', 'All posts')

@section('content')
    <main role="main" class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 blog-main">
                <h2 class="pb-3 mb-4 font-italic border-bottom" style="text-align: center">
                    Posts
                </h2>
                @foreach($posts as $post)
                    <div class="card" id="post-card">
                        <div class="card-body" style="text-align: center">
                            <a href="/posts/{{ $post->id }}"><h2 class="card-title">{{ $post->title }}</h2></a>
                            <p class="blog-post-meta">{{ $post->created_at->format('d/M/Y') }}</p>
                            <p class="card-text">{{ $post->body }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <style>
        #post-card {
            border: lightgrey 1px solid;
            background: whitesmoke;
            border-radius: 20px;
            box-shadow: 8px 8px 5px grey;
            margin-top: 20px
        }
    </style>
@endsection