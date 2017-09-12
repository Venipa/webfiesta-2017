@extends('layout.master')
@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Account</div>
            <div class="panel-body">
                @if (session()->has('message'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success fade in">
                        <i class="mdi mdi-check"></i> {{ session()->get('message') }}
                    </div>
                </div>
            </div>
                @endif
                <div class="row row-divide">
                    <div class="col-xs-4 col-sm-2">
                        <img src="{{Gravatar::fallback('/img/defaultprofile.png')->get(\Auth::user()->email, ['size' => 210])}}" alt="" class="img-responsive img-rounded">
                    </div>
                    <div class="col-xs-8 col-sm-10">
                        <p><strong>ID: </strong>{{sprintf("%s#%04d", \Auth::user()->username, intval(\Auth::user()->nEMID))}}</p>
                        <p><strong>Username: </strong>{{\Auth::user()->username}}</p>
                        <p><strong>Email: </strong>{{\Auth::user()->email}}</p>
                        <p><strong>Coins: </strong>{{\Auth::user()->nCoins}}</p>
                    </div>
                </div>
                <hr>
            <div class="row row-divide">
                <div class="col-xs-2">
                <h4>Change Password</h4>
                <p class="text-muted">Requirements: Minimum Lenght of 6 characters</p>
                </div>
                <div class="col-xs-10">
                <form method="post" action="{{route('post:passchange')}}">
                {{csrf_field()}}
                    <div class="form-group {{ $errors->has('opass') ? 'has-error' : '' }}">
                        <label for="opass">Current Password</label>
                        <input type="password" class="form-control" id="opass" name="opass" placeholder="{{str_repeat('*', 10)}}">
                        @if ($errors->has('opass'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('opass') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group {{ $errors->has('pass') ? 'has-error' : '' }}">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="">
                        @if ($errors->has('pass'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pass') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group {{ $errors->has('pass_confirmation') ? 'has-error' : '' }}">
                        <label for="cpass">Confirm Password</label>
                        <input type="password" class="form-control" id="cpass" name="pass_confirmation" placeholder="">
                        @if ($errors->has('pass_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pass_confirmation') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </form>
                </div>
            </div>
            @if(config('app.mall'))
                        <div class="row row-divide">
                            <div class="col-xs-2">
                                <h4>Redeem Card</h4>
                                <p class="text-muted">Requirements: an valid Giftcard from our Website</p>
                            </div>
                            <div class="col-xs-10">
                                <form method="post" action="{{route('post:giftcode')}}">
                                    {{csrf_field()}}
                                    <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                                        <label for="code">Code</label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="20 alphanumeric characters">
                                        @if ($errors->has('code'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-success">Redeem</button>
                                </form>
                            </div>
                        </div>
            @endif
            <div class="row row-divide">
                <div class="col-xs-2">
                    <h4>Notifications</h4>
                    <p class="text-muted">Get notifications about updates and such stuff</p>
                </div>
                <div class="col-xs-10">
                    <form method="post" action="{{route('post:giftcode')}}">
                        {{csrf_field()}}
                        <div class="form-group {{ $errors->has('notify') ? 'has-error' : '' }}">
                            <select name="notify" class="form-control">
                                <option value="0">Do not notify me</option>
                                <option value="1">Only notify about critical Updates/Notifications</option>
                                <option value="2">Notify about all Updates/Notifications</option>
                            </select>
                            @if ($errors->has('code'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection