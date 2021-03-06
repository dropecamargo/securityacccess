<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <title>IPS :: Software</title>
  
    {{--*/ 
      $background = (Request::getHost() == 'duitama.gruponaturalpower.in') ? '#A9F5BC' : '';
    /*--}}
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="{{ asset('js/ie-emulation-modes-warning.js') }}"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background-color: {{ $background }} !important;">
    <div class="container">
      @yield('content')
    </div>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>

    <style type="text/css">
      .footer {
        padding-top: 10px;
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 50px;
        background-color: #f5f5f5;
      }
    </style>
    <footer class="footer">
      <div class="container">
        <div align="center">
            Desarrollado por 
            <a href="http://www.koi-ti.com" target="_blank">
              {{ HTML::image('images/koi.png', 'KOI') }}
            </a>
            <a href="http://www.koi-ti.com" target="_blank">
              KOI Tecnologías de la Información S.A.S.
            </a>
        </div>     
      </div>
    </footer>
  </body>
</html>