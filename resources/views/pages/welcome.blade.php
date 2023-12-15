@extends('app')

@section('content')
    @guest
        <h3 class="text-center">Welcome in Booked ID</h3>
        <p class="text-center">Please <a href="/login" style="text-decoration: none">Login</a> or <a href="/register"
                style="text-decoration: none">Register</a>
            if not yet account</p>
    @else
        @can('admin')
            @livewire('books-component')
        @else
            @livewire('book-user')
        @endcan
    @endguest
@endsection
