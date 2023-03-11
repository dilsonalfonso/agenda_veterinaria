<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinaria Mis Animalitos</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}?a=16">
    <script src="{{ asset('js/js.js')}}?a=16"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/locales-all.js"></script>
</head>
<body>
<div class="todo">
    <figure id="home">
        <img src="{{asset('img/fondo.jpg')}}" alt="">
    </figure>
    <nav class="nav-top">
        <div class="nav-icon">
            <a href="{{route('/')}}"><img src="{{asset('img/logo.png')}}" alt="" height="40"></a>
        </div>
        <ul class="nav">
            <li class="nav-item"><a href="{{route('/')}}" class="nav-link" data-href="inicio">Inicio</a></li>
            <li class="nav-item"><a href="{{route('MascotasR')}}" class="nav-link" data-href="mascotas">Mascotas</a></li>
            <li class="nav-item"><a href="{{route('ClientesR')}}" class="nav-link" data-href="clientes">Clientes</a></li>
        </ul>
    </nav>
    <script src="{{ asset('js/veterinariaCalendar.js')}}?a=16"></script>
    <section class="contenido" id="plataforma">
        @yield('contenido')
    </section>
    <footer>
        <div class="footer">
            <img src="{{ asset('img/PerfilVertice.png')}}" alt="" height="100%">
            
        </div>
    </footer>
<div>
</body>
</html>