<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - FICertif</title>
    <link rel="icon" href="/img/logofi2.png">

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/miestilo.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>
    <header>
        <div class="container-fluid text-center">
            <a class="logo mb-5 mt-0" href="/">
                <img src="/img/logofi2.png">FICertif
            </a>
        </div>
    </header>

    <div class="contenedor-pagina row justify-content-center py-5 mx-0">
        <div class="form-container col-10 col-sm-8 col-md-6">
            <form class="text-center py-5 px-1 px-sm-3 login" method="POST" action="{{ route('administradores.login') }}">
                @csrf

                <h1>Administración</h1>

                <div class="row justify-content-center">
                    <div class="col-12 row justify-content-center">
                        <div class="col-12 col-sm-9 col-md-6 mb-3">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email o nombre de usuario" required>
                        </div>
                    </div>

                    <div class="col-12 row justify-content-center">
                        <div class="col-12 col-sm-9 col-md-6 mb-3">
                            <input type="password" id="contrasena" name="password" class="form-control" placeholder="Contraseña" required>
                        </div>
                    </div>

                    @if ($errors->any())
                        <p class="alerta col-12">El usario o contraseña no son correctos, intente nuevamente.</p>
                    @endif

                    <div class="col-12 col-lg-8 col-xl-6 row justify-content-center">
                        <div class="col-12 col-lg-6">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Recordarme
                            </label>
                        </div>

                        <div class="col-12 col-lg-6">
                            <button class="btn ficertifButton ml-lg-4" type="submit">Acceder</button>
                        </div>
                    </div>

                    <p class="mt-3 col-12"><a href="">¿Olvidaste tu contraseña?</a></p>
                    <p class="col-12"><a href="registro.php">Registrate</a></p>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <div class="container-fluid text-center">
            <div class="logo">
                <img src="/img/logofi.png">FICertif
            </div>

            <div class="row my-5 mx-2 text-center justify-content-center">
                <div class="form-container col-12 col-lg-6 row justify-content-center">
                    <form class="contacto col-12">
                        <h3>Contáctanos ante alguna duda o problema:</h3>

                        <input type="email" id="email6" name="email" class="form-control mb-3 mt-3" placeholder="Ingresa tu mail para que podamos comunicarnos con vos" required>
                        <textarea id="mensaje" name="mensaje" type="text" class="form-control mb-3" placeholder="Ingresá tu consulta..."></textarea>
                        <button class="btn btn-light" type="submit">Enviar</button>
                    </form>
                </div>

                <div class="redes col-12 col-lg-6 mt-5 mt-lg-0 px-0 px-lg-3">
                    <h3>También puedes seguirnos a traveś de las redes:</h3>

                    <div class="row justify-content-center mt-3">
                        <div class="col-6 col-sm-3 col-md-2"><a href=""><i class="fa fa-facebook-official"></i></a></div>
                        <div class="col-6 col-sm-3 col-md-2"><a href=""><i class="fa fa-twitter-square"></i></a></div>
                        <div class="col-6 col-sm-3 col-md-2"><a href=""><i class="fa fa-instagram"></i></a></div>
                        <div class="col-6 col-sm-3 col-md-2"> <a href=""><i class="fa fa-google-plus-official"></i></a></div>
                    </div>
                </div>
            </div>

            <p class="copyright"><i class="fa fa-copyright"></i>  ficertif 2018</p>
        </div>
    </footer>
</body>
</html>
