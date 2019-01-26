@extends('layout')

@section('title', 'Agregar perfil - FICertif')

@section('head-particular')
    <link rel="stylesheet" type="text/css" href="/css/formulario.css">
@endsection

@section('contenido')
    <div class="form-container col-10 col-lg-8 py-5 px-1 px-sm-3 row justify-content-center mx-auto">
        <form class="formulario-principal color-blanco" method="POST" action="/perfiles" enctype="multipart/form-data">
            @csrf

            <h1 class="text-center">Registrar perfil</h1>

            <div class="row cuerpo-form">
                <div class="col-sm-12 col-md-6 elemento-form">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Juan Martín" required>

                    @if ($errors->has('nombre'))
                        <p class="alerta">El nombre no puede quedar vacío</p>
                    @endif
                </div>

                <div class="col-sm-12 col-md-6 elemento-form">
                    <label for="apellido">Apellido</label>
                    <input id="apellido" name="apellido" type="text" class="form-control" placeholder="Pérez González" required>

                    @if ($errors->has('apellido'))
                        <p class="alerta">El apellido no puede quedar vacío</p>
                    @endif
                </div>

                <div class="col-sm-12 col-md-6 elemento-form">
                    <label for="telefono">Teléfono</label>
                    <input id="telefono" name="telefono" type="tel" class="form-control" placeholder="+54..." required>

                    @if ($errors->has('telefono'))
                        <p class="alerta">Ingrese un teléfono válido.</p>
                    @endif
                </div>

                <div class="col-sm-12 col-md-6 elemento-form">
                    <label for="email">E-mail</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="xxx@xxx.xxx" required>

                    @if ($errors->has('email'))
                        <p class="alerta">El email es inválido o ya existe.</p>
                    @endif
                </div>

                <div class="col-sm-12 col-md-6 elemento-form">
                    <label for="organismo">Organismo</label>
                    <input id="organismo" name="organismo" type="text" class="form-control" placeholder="Organismo" required>

                    @if ($errors->has('organismo'))
                        <p class="alerta">Debe indicar un organismo.</p>
                    @endif
                </div>

                <div class="col-sm-12 col-md-6 elemento-form">
                    <label for="cargo">Cargo</label>
                    <input id="cargo" name="cargo" type="text" class="form-control" placeholder="Cargo" required>

                    @if ($errors->has('cargo'))
                        <p class="alerta">Debe indicar un cargo.</p>
                    @endif
                </div>
            </div>

            <div class="row justify-content-center">
                <button id="enviar" class="btn ficertifButton" type="submit">Registrar</button>
            </div>
        </form>
    </div>
@endsection
