@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card p-4">
      <h1 class="h4 mb-3">Log in</h1>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" name="remember" value="1" id="remember" class="form-check-input">
          <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <button class="btn btn-soft w-100">Log In</button>
        <div class="text-center mt-3">
          New here? <a href="{{ route('register') }}">Create an account</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
