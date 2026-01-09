<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Proyecto · ProjectGest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">ProjectGest</a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>proyecto" class="nav-link">
                            <i class="fas fa-arrow-left"></i> Mis Proyectos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>tarea" class="nav-link">Tareas</a>
                    </li>
                       <!--Mostrar nombre usuario logueado-->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user"></i>
                            <?= htmlspecialchars($_SESSION['user_name']) ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>auth/logout" class="nav-link">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- FORM -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <div class="card shadow-sm">
                    <div class="card-body p-4">

                        <h2 class="mb-4 text-center">
                            <i class="fas fa-edit"></i> Editar Proyecto
                        </h2>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST">

                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título del proyecto</label>
                                <input type="text" id="titulo" name="titulo" class="form-control"
                                    value="<?= htmlspecialchars($proyecto->titulo) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea id="descripcion" name="descripcion" class="form-control"
                                    rows="4"><?= htmlspecialchars($proyecto->descripcion) ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control"
                                        value="<?= htmlspecialchars($proyecto->fecha_inicio) ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="fecha_fin" class="form-label">Fecha de fin</label>
                                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control"
                                        value="<?= htmlspecialchars($proyecto->fecha_fin) ?>">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="<?= BASE_URL ?>proyecto" class="btn btn-outline-secondary">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Guardar Cambios
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="py-3 bg-light text-center">
        <div class="container">
            <small class="text-muted">
                © <?= date('Y') ?> ProjectGest
            </small>
        </div>
    </footer>

</body>

</html>