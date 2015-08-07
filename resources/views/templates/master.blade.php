<!DOCTYPE html>
<html lang="en">

  <head>
    @include('partials/head')
  </head>

  <body>

    <!-- Navigation -->
    @include('partials/navigation')

    <!-- Content -->
    <div class="wrap">
      @yield('content')
    </div>

    <!-- Scripts -->
    @yield('before_scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    @if(env('APP_ENV') === 'local')
      <script src="https://fb.me/react-0.13.3.js"></script>
    @else
      <script src="https://fb.me/react-0.13.3.min.js"></script>
    @endif
    <script src="https://fb.me/JSXTransformer-0.13.3.js"></script>
    <script type="text/jsx" src="{{ asset('/js/main.js') }}"></script>
    @yield('after_scripts')

  </body>

</html>
