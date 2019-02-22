@extends('layouts.master')

@section('title', 'Users posts')

@section('content')
    <div class="container">
        @foreach($user->posts as $post)
            <div class="card" style="border: lightgrey 1px solid; background: whitesmoke; border-radius: 20px; box-shadow: 8px 8px 5px grey;">
                <div class="card-body">
                    <a href="posts/{{ $post->id }}"><h1 class="card-title">{{ str_limit($post->title, $limit = 25, $end = '...') }}</h1></a>
                    <p class="card-text">{{ str_limit($post->body, $limit = 350, $end = '...') }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection