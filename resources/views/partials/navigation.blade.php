<nav class="navigation navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Digipes</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <!--<ul class="nav navbar-nav logo">
        <li><a href="{{ url('/') }}">Home</a></li>
      </ul>-->

      <ul class="nav navbar-nav navbar-right">
        @if(Auth::guest())
          <li><a href="{{ url('/login') }}">Login</a></li>
          <li><a href="{{ url('/register') }}">Register</a></li>
        @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->username }} <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('/cookbooks') }}">Cookbooks</a></li>
              <li><a href="{{ url('/account') }}">Account</a></li>
              <li><a href="{{ url('/logout') }}">Logout</a></li>
            </ul>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>