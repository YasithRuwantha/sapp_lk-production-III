<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.partials.head')
  </head>
  @if(Route::is(['error404','error500']))
  <body class="error-page">
  @endif
  @if(!Route::is(['login','register','forgotpassword','lockscreen','error404','error500']))
@include('layout.partials.header')
@include('layout.partials.nav')
@endif
@yield('content')
@include('layout.partials.footer-scripts')
  </body>
</html>