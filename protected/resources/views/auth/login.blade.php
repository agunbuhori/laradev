@extends('layouts.auth')

@section('content')
<!-- Simple login form -->
<form action="login" method="post">
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
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>

        <div class="form-group login-options">
            <div class="row">
                <div class="col-sm-6">
                    <label class="checkbox-inline">
                        <input type="checkbox" class="styled" checked="checked" name="remember">
                        Remember
                    </label>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="login_password_recover.html">Forgot password?</a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn bg-pink-400 btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
        </div>
    </div>
</form>
<!-- /simple login form -->
@endsection
