@extends('layouts.master')

@section('title', 'Login')

@section('content')
    <h1 class="pb-3 mb-4 font-italic border-bottom" style="text-align: center">
        Login
    </h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group row">
            <div class="col-8">
                {{-- is-invalid is imporatnt, it will connect with invalid-feedback from blade --}}
                <input id="text" name="email" type="email" class="form-control
                        {{ $errors->has('email') ? 'is-invalid' : '' }}"
                       placeholder="Email" value="{{ old('email') }}">
                {{-- Validation, we pass to our blade name of our input--}}
                @include('partials.invalid-feedback', ['field' => 'email'])
            </div>
        </div>
        <div class="form-group row">
            <div class="col-8">
                <input id="text" name="password" type="password" class="form-control
                        {{ $errors->has('password') ? 'is-invalid' : '' }}"
                       placeholder="Password" value="{{ old('password') }}">
                @include('partials.invalid-feedback', ['field' => 'password'])
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
        <div class="form-group">
            {{-- We get this message from LoginController --}}
            <input class="form-control {{ $errors->has("message") ? "is-invalid" : "" }}" type="hidden">
            @include('partials.invalid-feedback', ['field' => 'message'])
        </div>
    </form>
@endsection