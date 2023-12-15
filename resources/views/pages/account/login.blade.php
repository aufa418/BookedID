@extends('app')

@section('content')
    @if (Session()->has('success'))
        <div class="alert alert-success w-50 mx-auto" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (Session()->has('error'))
        <div class="alert alert-danger w-50 mx-auto" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="card w-70 mx-auto">
        <div class="card-body">
            <h2 class="card-title text-center">Login Form</h2>
            <hr>
            <form method="post" action="/login">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                </div>
                <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <p>Not Have Account? <a href="/register" style="text-decoration: none">Register</a></p>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
