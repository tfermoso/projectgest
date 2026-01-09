<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Proyectos · ProjectGest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        .project-card {
            min-height: 100%;
        }

        .task-card {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
        }
    </style>
</head>

<body class="bg-light">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">ProjectGest</a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item me-2">
                        <a href="<?= BASE_URL ?>proyecto/nuevo" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Nuevo Proyecto
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>auth/logout" class="nav-link">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="container py-4">

        <h2 class="mb-4">📁 Mis Proyectos</h2>

        <?php if ($proyectos->isEmpty()): ?>
            <div class="alert alert-info">
                No tienes proyectos creados todavía.
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-info">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <div class="row g-4">
            <?php foreach ($proyectos as $proyecto): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="card shadow-sm project-card">

                        <!-- HEADER PROYECTO -->
                        <div class="card-header bg-white d-flex justify-content-between align-items-start">
                            <strong>
                                <?= htmlspecialchars($proyecto->titulo) ?>
                            </strong>

                            <div class="btn-group btn-group-sm">
                                <a href="<?= BASE_URL ?>proyecto/editar/<?= $proyecto->proyecto_id ?>"
                                    class="btn btn-outline-secondary" title="Editar proyecto">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <?php if ($proyecto->tareas->isEmpty()): ?>
                                    <a href="<?= BASE_URL ?>proyecto/eliminar/<?= $proyecto->proyecto_id ?>"
                                        class="btn btn-outline-danger" title="Eliminar proyecto"
                                        onclick="return confirm('¿Seguro que quieres eliminar este proyecto?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- BODY PROYECTO -->
                        <div class="card-body">

                            <p class="small text-muted">
                                <?= nl2br(htmlspecialchars($proyecto->descripcion)) ?>
                            </p>

                            <p class="small mb-2">
                                📅 <?= htmlspecialchars($proyecto->fecha_inicio) ?>
                                →
                                <?= htmlspecialchars($proyecto->fecha_fin) ?>
                            </p>

                            <hr>

                            <!-- TAREAS -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="text-muted mb-0">Tareas</h6>
                                <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalTarea<?= $proyecto->proyecto_id ?>" title="Nueva tarea">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>

                            <?php if ($proyecto->tareas->isEmpty()): ?>
                                <p class="small text-muted">
                                    No hay tareas todavía
                                </p>
                            <?php else: ?>
                                <?php foreach ($proyecto->tareas as $tarea): ?>
                                    <div class="card task-card mb-2">
                                        <div class="card-body p-2">

                                            <div class="d-flex justify-content-between align-items-start">
                                                <strong class="small">
                                                    <?= htmlspecialchars($tarea->titulo) ?>
                                                </strong>

                                                <?php if (
                                                    $tarea->estado_id == 1 &&
                                                    is_null($tarea->comentarios)
                                                ): ?>
                                                    <a href="<?= BASE_URL ?>proyecto/eliminartarea/<?= $tarea->tarea_id ?>" class="text-danger"
                                                        title="Eliminar tarea"
                                                        onclick="return confirm('¿Seguro que quieres eliminar esta tarea?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>

                                            <p class="small mb-1">
                                                <?= htmlspecialchars($tarea->descripcion) ?>
                                            </p>

                                            <p class="small text-muted mb-0">
                                                <i class="fas fa-user"></i>
                                                <?= htmlspecialchars($tarea->usuario->nombre ?? 'Sin asignar') ?>
                                            </p>

                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>

                    <!-- MODAL NUEVA TAREA -->
                    <div class="modal fade" id="modalTarea<?= $proyecto->proyecto_id ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <form method="POST"
                                    action="<?= BASE_URL ?>proyecto/nuevatarea/<?= $proyecto->proyecto_id ?>">

                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Nueva tarea · <?= htmlspecialchars($proyecto->titulo) ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="form-label">Título</label>
                                            <input type="text" name="titulo" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Descripción</label>
                                            <textarea name="descripcion" class="form-control" rows="3"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Usuario asignado</label>
                                            <select name="usuario_id" class="form-select" required>
                                                <?php foreach ($usuarios as $usuario): ?>
                                                    <option value="<?= $usuario->usuario_id ?>"
                                                        <?= $usuario->usuario_id == $_SESSION['user_id'] ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($usuario->nombre) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Crear tarea
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>