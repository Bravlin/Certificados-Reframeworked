<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'FiCertif')</title>
    <link rel="icon" href="/img/logofi2.png">

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/miestilo.css">

    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    @yield('head-particular')
</head>
<body>
    <header>
        <div class="container-fluid text-center">
            <div class="logo mb-5 mt-0" href="/">
                <img src="/img/logofi2.png">FICertif
            </div>
        </div>
    </header>

    @yield('contenido')

    <footer>
        <div class="container-fluid text-center">
            <div class="logo">
                <img src="/img/logofi.png">FICertif
            </div>

            <div class="row my-5 mx-2 text-center justify-content-center">
                <div class="form-container col-12 col-lg-6 row justify-content-center">
                    <form class="contacto col-12">
                        <h3>Contactanos ante alguna duda o problema:</h3>

                        <input type="email" id="email6" name="email" class="form-control mb-3 mt-3" placeholder="Ingresa tu mail para que podamos comunicarnos con vos" required>
                        <textarea id="mensaje" name="mensaje" type="text" class="form-control mb-3" placeholder="Ingresá tu consulta..."></textarea>
                        <button class="btn btn-light" type="submit">Enviar</button>
                    </form>
                </div>

                <div class="redes col-12 col-lg-6 mt-5 mt-lg-0 px-0 px-lg-3">
                    <h3>También podés seguirnos a través de las redes:</h3>

                    <div class="row justify-content-center mt-3">
                        <div class="col-4 col-md-2"><a href=""><i class="fa fa-facebook-official"></i></a></div>
                        <div class="col-4 col-md-2"><a href=""><i class="fa fa-twitter-square"></i></a></div>
                        <div class="col-4 col-md-2"><a href=""><i class="fa fa-instagram"></i></a></div>
                    </div>
                </div>
            </div>

            <p class="copyright mb-0">Departamento de Informática - Facultad de Ingeniería, U.N.M.D.P.</p>
        </div>
    </footer>

    @yield('pos-scripts')
</body>
</html>
