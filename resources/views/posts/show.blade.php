@extends('layouts.master')

@section('title', $post->title)

@section('content')
    <div class="container" style="text-align: center; margin-top: 10px">
        @if (session('message'))
            <div class="alert alert-success" role="alert" style="text-align: center">
                {{ session('message') }}
            </div>
        @endif
        {{-- Post --}}
        <div class="card" style="border: lightgrey 1px solid; background: whitesmoke; border-radius: 20px; box-shadow: 8px 8px 5px grey;">
            <div class="card-body">
                <h1 class="card-title"> {{ $post->title }}</h1>
                <p class="card-text">{{ $post->body }}</p>
                <p style="font-style: italic;">by</p>
                {{-- We get users name in Post Model--}}
                @if($post->user)
                    <h4>{{ $post->user->name }}</h4>
                @endif
            </div>
        </div>
        @if(auth()->user()->id == $post->user_id)
            <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary" style="margin-top: 20px">Edit</a>
            <form method="POST" action="/posts/ {{ $post->id }}">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        @endif
        {{-- Comments --}}
        <h2 class="pb-3 mb-4 font-italic border-bottom" style="margin-top: 30px">Comments</h2>
        <div class="d-flex flex-row">
            @foreach($post->comments as $comment)
                <div class="card" style="width: 18rem; text-align: center; background: lightgreen; border-radius: 20%; margin-left: 10px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $comment->author }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">says</h6>
                        <p class="card-text">{{ $comment->text }}</p>
                        <div class="text-muted">{{ $comment->created_at }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- Add comment --}}
    <div class="container" style="padding-top: 20px">
        <form method="POST" action="{{ route(('posts-comment'), ['id' => $post->id]) }}">
            @csrf
            <div class="form-group row">
                <div class="col-8">
                    {{-- is-invalid is imporatnt, it will connect with invalid-feedback from blade --}}
                    <input id="text" name="author" type="text" class="form-control
                            {{ $errors->has('author') ? 'is-invalid' : '' }}"
                            placeholder="Author" value="{{ old('author') }}" required>
                            {{-- Validation, we pass to our blade name of our input--}}
                    @include('partials.invalid-feedback', ['field' => 'author'])
                </div>
            </div>
            <div class="form-group row">
                <div class="col-8">
                    <textarea id="textarea" name="text" cols="40" rows="5" class="form-control
                            {{ $errors->has('text') ? 'is-invalid' : '' }}" placeholder="Text" required>{{ old('text') }}</textarea>
                    @include('partials.invalid-feedback', ['field' => 'text'])
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="javascript: history.go(-1)" class="btn btn-primary">Go back</a>
                </div>
            </div>
        </form>
    </div>
@endsection