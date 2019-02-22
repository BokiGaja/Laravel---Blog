@extends('layouts.master')

@section('title', 'Register')

@section('content')
    <div class="container">
        <h1 class="pb-3 mb-4 font-italic border-bottom" style="text-align: center">
            Register user
        </h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row">
                <div class="col-8">
                    {{-- is-invalid is imporatnt, it will connect with invalid-feedback from blade --}}
                    <input id="text" name="name" type="text" class="form-control
                            {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           placeholder="Name" value="{{ old('name') }}">
                    {{-- Validation, we pass to our blade name of our input--}}
                    @include('partials.invalid-feedback', ['field' => 'name'])
                </div>
            </div>
            <div class="form-group row">
                <div class="col-8">
                    <input id="text" name="email" type="email" class="form-control
                            {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           placeholder="Email" value="{{ old('email') }}">
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
            <div class="form-group">
                <label for="age">Age</label>
                <select name="age" id="age" class="form-control" style="width: 65px">
                    @for($i = 1; $i <= 100; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                @include('partials.invalid-feedback', ['field' => 'age'])
            </div>

            @if($message = session('message'))
                <div class="alert alert-danger" role="alert" style="text-align: center">
                    {{ $message }}
                </div>
            @endif

            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </div>
        </form>
    </div>
@endsection