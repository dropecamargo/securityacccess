<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <title>Security Access Software</title>
    {{--*/ 
      $background = (Request::getHost() == 'duitama.gruponaturalpower.in') ? '#A9F5BC' : '';
    /*--}}

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/alertify.core.css') }}" rel="stylesheet">
    <link href="{{ asset('css/alertify.default.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('bootstrap/css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
    
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <script src="{{ asset('js/ie-emulation-modes-warning.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background-color: {{ $background }} !important;">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Security Access</a>

        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">{{ Auth::user()->name; }}</a></li>
            <li>{{ HTML::link('/logout', 'Cerrar sesión') }}</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">      
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
              <li>{{ HTML::linkRoute('usuarios.index', 'Usuarios') }}</li>
              <li>{{ HTML::linkRoute('ciudades.index', 'Ciudades') }}</li>
              <li>{{ HTML::linkRoute('ordenes.index', 'Ordenes de servicio') }}</li>
          </ul>
        </div>
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- Loading app -->
          <div id="loading-app" class="modal fade" role="dialog" aria-hidden="true"></div>
          <!-- Error app -->
          <div id="error-app" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Cerrar</span></button>
                    <h4 class="modal-title">Error :: Security Access</h4>
                </div>
                <div class="modal-body">
                  <div id="error-app-label" class="alert alert-danger"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- Content app -->          
          @yield('content')             
        </div>
      </div>  
    </div>

    <script>window.document.url = "{{ URL::to('/') }}";</script> <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/docs.min.js') }}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>
    <script src="{{ asset('js/alertify.min.js') }}"></script>
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

  </body>
</html>