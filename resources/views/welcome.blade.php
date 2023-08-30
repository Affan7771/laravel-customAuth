@extends('layout.main')

@section('content')
    @auth
        <h2>Welcome, <strong>{{ Auth::user()->first_name; }}</strong></h2>
    @else
        <h2>Welcome, <strong>Guest</strong></h2>
    @endauth
@endsection
