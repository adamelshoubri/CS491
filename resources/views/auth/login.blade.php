@extends('layouts.app')

@section('content')


<div class="container" align="center">
    <div class="col-md-6 mt-5" align="left">
        <form class="form-signin" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="email" class="sr-only">Email address</label>
            <input input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" class="form-control mt-3" placeholder="Email address" required autofocus>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <div class="checkbox">
                <label>
                <input type="checkbox" value="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
        <a class="btn btn-link" href="{{ route('password.request') }}">
            Forgot Your Password?
        </a>
    </div>
</div>
@endsection
