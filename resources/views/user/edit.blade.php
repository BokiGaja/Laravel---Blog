@extends('layouts.master')

@section('title', 'Users')

@section('content')
    <div class="container" style="text-align: center">
    <h1>Users</h1>
        <div class="row">
        @foreach($users as $user)
            <div class="card" style="width: 10rem; text-align: center; background: lightcyan; border-radius: 5%; margin-top: 10px; margin-left: 20px">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <form method="POST" action="{{ route(('delete-user'), ['user' => $user->id]) }}">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection