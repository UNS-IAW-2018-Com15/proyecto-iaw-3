<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>La Caprichosa: Admin</title>
    
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel='stylesheet' href='/css/bootstrap/bootstrap.min.css' />
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans|Raleway|Fredoka+One|Open+Sans" rel="stylesheet">
    <link id='css-estilo' rel='stylesheet' href='{{ asset("css/nuevo.css") }}' />
    <link id='css-estilo' rel='stylesheet' href='{{ asset("css/estilo1.css") }}' />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!--<script type='text/javascript' src='/javascripts/estilos.js'></script>
    <script type='text/javascript' src='/javascripts/local-storage.js'></script>
    <script type='text/javascript' src='/javascripts/funciones.js'></script>
    <script type='text/javascript' src='/javascripts/mapa.js'></script>
    <script type='text/javascript' src='/javascripts/comentarios.js'></script>-->
  </head>
  <body class="miBody">
    @include('header')
    @yield('content')

 	 <script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
  </body>
</html>
