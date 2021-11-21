<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        @include('layouts_comp.meta')
        @yield('styles')
    </head>
    <body class="d-flex flex-column h-100">
      @include('layouts_comp.nav')

      @yield('content')

      @include('layouts_comp.footer')

      <script src="{{ asset('js/app.js') }}"></script>
      @yield('scripts')
    </body>
</html>
