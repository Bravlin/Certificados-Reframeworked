<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FiCertif')</title>
    <meta charset="utf-8">
    <link rel="icon" href="/img/logofi2.png">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/miestilo.css">
    <link rel="stylesheet" type="text/css" href="/css/navegacion.css">
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    @yield('head-particular')
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark minavbar">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navegacionPrincipal" aria-controls="navegacionPrincipal" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand d-none d-sm-inline-block" href="index.php">
            <img class="logo" src="/img/logofi.png" alt="FI">
        </a>
        <form class="form-check-inline mx-0 mx-md-5" action="busqueda.php" method="get">
            <input type="hidden" name="filtro" value="nombre"/>
            <input class="form-control mr-sm-2 my-2" type="search" name="consulta" placeholder="Buscar..." aria-label="Search" required>
            <button class="boton-busqueda" type="submit"><i class="fa fa-search"></i></button>
        </form>
        <div class="collapse navbar-collapse" id="navegacionPrincipal">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="lib/sesion-baja.php"><i class="fa fa-sign-out mr-1"></i>Salir</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <aside class="d-none d-md-block col-md-3 col-lg-2 barra-vertical pt-5">
                <div class="lista-navegables rounded fondo-gris py-3">
                    <ul class="pl-0 mx-md-3">
                        <li class="mb-3"><a href="index.php"><i class="fa fa-home"></i>Inicio</a></li>
                        <li class="mb-3"><a href="certificados.php"><i class="fa fa-file"></i>Certificados</a></li>
                        <li class="mb-3"><a href="eventos.php"><i class="fa fa-calendar"></i>Eventos</a></li>
                        <li><a href="/perfiles"><i class="fa fa-user"></i>Perfiles</a></li>
                    </ul>
                </div>
            </aside>

            <div class="col-12 col-md-9 col-lg-10 py-5">
                @yield('contenido')
            </div>
        </div>
    </div>

    <footer>
        <div class="fixed-bottom fondo-gris d-block d-md-none barra-fondo text-center">
            <div class="row">
                <div class="col-3">
                    <a href="index.php">
                        <i class="fa fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </div>
                <div class="col-3">
                    <a href="certificados.php">
                        <i class="fa fa-file"></i>
                        <p>Certificados</p>
                    </a>
                </div>
                <div class="col-3">
                    <a href="eventos.php">
                        <i class="fa fa-calendar"></i>
                        <p>Eventos</p>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/perfiles">
                        <i class="fa fa-user"></i>
                        <p>Perfiles</p>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    @yield('post-scripts')
</body>
</html>
