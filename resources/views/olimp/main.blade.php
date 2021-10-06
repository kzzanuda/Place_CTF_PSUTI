<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.meta')
        @yield('styles')
    </head>
    <body>
      @include('layouts.nav')

      @yield('content')

      @include('layouts.footer')

      <script src="{{ asset('js/app.js') }}"></script>
      @yield('sripts')
    </body>
</html>
