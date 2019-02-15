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
                    <div class="card post-card">
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

{{ URL::asset('css/posts-index.css') }}
@endsection