<!doctype html>
<html lang="en">
  <head>
    <title>{{$title or 'DJERICMAX | Site Oficial'}}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    

  </head>
  <body>      
    
        @yield('content')



      @stack('scripts')
  </body>
</html>