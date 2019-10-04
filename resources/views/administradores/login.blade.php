@extends('publico')

@section('title', 'Login admin - FICertif')

@section('head-particular')
    <link rel="stylesheet" type="text/css" href="/css/login.css">
@endsection

@section('contenido')
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
@endsection
