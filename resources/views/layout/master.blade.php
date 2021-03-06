<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>{{config('app.name')}}</title>
  <link rel="icon" type="image/png" href="{{ url('/img/fav.png') }}" />
  <!-- Bootstrap -->
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="/css/todc-bootstrap.min.css" rel="stylesheet">
  <link href="/css/select2.css" rel="stylesheet">
  <link href="/css/tippy.css" rel="stylesheet">
  <link href="/css/app.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  @yield('css')
</head>
<body>
<nav class="navbar navbar-toolbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">{{config('app.name')}}</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="/">Home</a></li>
        <li><a href="{{route('get:downloads')}}">Download</a></li>
        @if(config('app.mall'))
          <li><a href="{{route('get:shop')}}">Shop</a></li>
        @endif
        <li><a href="{{route('get:top:exp')}}">Top</a></li>
        <li><a href="{{route('get:faq')}}">FAQ</a></li>
        <li><a href="https://discordapp.com/invite/uFpEtCG" target="_blank">Discord</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@if(\Auth::guest())Login or Register @else <i class="mdi mdi-account"></i> {{\Auth::user()->email}} @endif<span class="caret"></span></a>
          <ul class="dropdown-menu">
            @if(\Auth::check())
              <li><a href="{{route('get:account')}}"><i class="mdi mdi-account-settings-variant"></i> My Account</a></li>
              <li><a href="{{route('get:account.characters')}}"><i class="mdi mdi-account-multiple"></i> My Characters</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{route('get:logout')}}"><i class="mdi mdi-power"></i> Logout</a></li>
            @else
              <li><a href="{{route('login')}}">Login</a></li>
              <li><a href="{{route('register')}}">Register</a></li>
            @endif
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="wrapper">
  <div class="page-loading-wrapper">
    <div class="page-load"></div>
  </div>
  @if(config('fiesta.maintenance.status'))
    <div class="container">
    @foreach(config('fiesta.maintenance.messages') as $msg)
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger"><i class="mdi mdi-alert"></i> {{$msg}}</div>
          </div>
      </div>
      @endforeach
      </div>
    @endif
  @yield('body')
  <div class="container">
    <div class="row">
      <div class="col-md-12"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Normal Responsive -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-5409324519540568"
             data-ad-slot="2285861931"
             data-ad-format="auto"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script></div>
    </div>
  </div>
</div>
<footer class="footer">
  <div class="container">
    <p class="text-muted">{{config('app.name', 'Fiesta')}} &copy; {{config('app.owner')}} - {{date('Y')}}</p>
  </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/select2.min.js"></script>
<script src="/js/ripple.min.js"></script>
<script src="/js/sweetalert2.min.js"></script>
<script src="/js/wf.js"></script>
<script src="/js/macy.js"></script>
<script src="/js/tippy.min.js"></script>
<script src="/js/app.js"></script>
@yield('js')
</body>
</html>