@extends('layouts.auth')

@section('content')


<!-- Simple login form -->
<form action="{{ url('login') }}" method="post">
    {{ csrf_field() }}
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
            <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input type="text" class="form-control" placeholder="Email" name="email">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
            @if ($errors->has('password'))
            <label id="with_icon-error" class="validation-error-label" for="with_icon">Account isn't registered.</label>
            @endif
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
            @if ($errors->has('password'))
            <label id="with_icon-error" class="validation-error-label" for="with_icon">Password is wrong.</label>
            @endif
        </div>

        <div class="checkbox mb-20">
            <label>
                <input type="checkbox" name="remember">
                Keep login
            </label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
        </div>

        <div class="text-center">
            <a href="login_password_recover.html">Forgot password?</a>
        </div>
    </div>
</form>
<!-- /simple login form -->
@endsection
