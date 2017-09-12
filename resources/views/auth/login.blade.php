@extends('layout.master') @section('body')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
            <div class="card">
                <div class="card-image">
                    <img class="img-responsive" src="/img/h1.jpg">
                    <span class="card-title">Login</span>
                </div>

                <form method="post" action="">
                {{csrf_field()}}
                    <div class="card-content">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" name="password" id="pass" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                        @if(config("app.env") != "local")
                        <div class="form-group {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
                        {!! Recaptcha::render() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                        </div>
                        @endif
                    </div>

                    <div class="card-action">
                        <button class="btn btn-success" type="submit">Login</button>
                        <button class="btn btn-default" data-href="{{route('register')}}">Register</button>
                        <button class="btn btn-link" data-href="{{route('password.request')}}">Forgot Password?</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection