@extends('layouts.master')

@section('title', 'Create post')

@section('content')
    <div class="container">
        <h1 class="pb-3 mb-4 font-italic border-bottom" style="text-align: center">
            Create post
        </h1>
        <form method="POST" action="{{ route('posts-store') }}">
            @csrf
            <div class="form-group row">
                <div class="col-8">
                    {{-- is-invalid is imporatnt, it will connect with invalid-feedback from blade --}}
                    <input id="text" name="title" type="text" class="form-control
                        {{ $errors->has('title') ? 'is-invalid' : '' }}"
                           placeholder="Title" value="{{ old('title') }}">
                    {{-- Validation, we pass to our blade name of our input--}}
                    @include('partials.invalid-feedback', ['field' => 'title'])
                </div>
            </div>
            <div class="form-group row">
                <div class="col-8">
                    <textarea id="textarea" name="body" cols="40" rows="5" class="form-control
                        {{ $errors->has('body') ? 'is-invalid' : '' }}" placeholder="Body">{{ old('body') }}</textarea>
                    @include('partials.invalid-feedback', ['field' => 'body'])
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