<!doctype html>
<html lang="en">
  <head>
  <title>{{$title or 'DJERICMAX | Oficial'}}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous">
  <link rel="stylesheet" href="{{url('assets/painel/css/style.css')}}">
  </head>
  <body>

    <div class="container">
        @yield('content')
    </div>
  </body>
</html>