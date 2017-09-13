@extends('layout.master') @section('body')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
            <div class="card">
                <div class="card-image">
                    <img class="img-responsive" src="/img/h2.jpg">
                    <span class="card-title">Register</span>
                </div>

                <form method="post" action="">
                {{csrf_field()}}
                    <div class="card-content">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" name="password" id="pass" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label for="pass_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="pass_confirmation" placeholder="Confirm Password" required> 
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
                        {!! Recaptcha::render() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>

                    <div class="card-action">
                        <button class="btn btn-success" type="submit" data-toggle="tooltip" title="By pressing this Button you will agree to our ToS">Register</button>
                        <button class="btn btn-link" data-href="{{route('login')}}">Already registered?</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection