<!-- HEADER -->
  <nav class="navbar navbar-default ">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
          <img src="/images/logo-blanco.png" alt="Logo La Caprichosa" class="logo">
        </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class=""><a href="#">Panel de Administracion</a></li>


        </ul>
        <ul class="nav navbar-nav navbar-right">
          @guest
            <li><a href="/login">Login</a></li>
            <!--<li><a href="/register">Register</a></li>-->
          @else
            <li><a href="/logout">Logout</a></li>
          @endguest
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
<!-- FIN HEADER -->