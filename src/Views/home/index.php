<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ProjectGest · Gestión de Proyectos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">ProjectGest</a>

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/auth/login" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <a href="/auth/register" class="btn btn-outline-light ms-2">Registro</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="py-5 text-center bg-white">
    <div class="container">
        <h1 class="display-5 fw-bold">Gestiona tus proyectos de forma sencilla</h1>
        <p class="lead text-muted mt-3">
            ProjectGest es una aplicación web para organizar proyectos, asignar tareas
            y colaborar con tu equipo desde un único lugar.
        </p>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="/auth/login" class="btn btn-primary btn-lg">
                Iniciar sesión
            </a>
            <a href="/auth/register" class="btn btn-outline-primary btn-lg">
                Crear cuenta
            </a>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">📁 Proyectos</h5>
                        <p class="card-text">
                            Crea y gestiona proyectos con fechas, descripción y responsables.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">✅ Tareas</h5>
                        <p class="card-text">
                            Divide cada proyecto en tareas y asigna usuarios fácilmente.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">👥 Colaboración</h5>
                        <p class="card-text">
                            Cada usuario puede ver sus proyectos y las tareas asignadas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 bg-dark text-white text-center">
    <div class="container">
        <h2 class="fw-bold">Empieza a organizar tus proyectos hoy</h2>
        <p class="mt-3">
            Regístrate gratis y comienza a trabajar con ProjectGest.
        </p>
        <a href="/auth/register" class="btn btn-primary btn-lg mt-3">
            Crear cuenta
        </a>
    </div>
</section>

<!-- FOOTER -->
<footer class="py-3 bg-light text-center">
    <div class="container">
        <small class="text-muted">
            © <?= date('Y') ?> ProjectGest · Framework MVC en PHP
        </small>
    </div>
</footer>

</body>
</html>
