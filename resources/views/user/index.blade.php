@extends('layouts.master')

@section('title', 'Users posts')

@section('content')
    @foreach($user->posts as $post)
        <div class="card" style="border: lightgrey 1px solid; background: whitesmoke; border-radius: 20px; box-shadow: 8px 8px 5px grey;">
            <div class="card-body">
                <a href="posts/{{ $post->id }}"><h1 class="card-title"> {{ $post->title }}</h1></a>
                <p class="card-text">{{ $post->body }}</p>
            </div>
        </div>
    @endforeach
@endsection