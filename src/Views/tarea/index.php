<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Tareas · ProjectGest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        .task-disabled {
            opacity: 0.4;
        }

        .project-muted {
            opacity: 0.6;
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
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>proyecto" class="nav-link">Proyectos</a>
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

    <!-- CONTENT -->
    <div class="container py-4">
        <h2 class="mb-4">📝 Mis Tareas</h2>

        <?php foreach ($tareasPorProyecto as $proyecto): ?>
            <?php
            $tareasUsuario = $proyecto->tareas->where('usuario_id', $_SESSION['user_id']);
            ?>

            <div class="card mb-4 shadow-sm <?= $tareasUsuario->isEmpty() ? 'project-muted' : '' ?>">
                <div class="card-header bg-white">
                    <strong><?= htmlspecialchars($proyecto->titulo) ?></strong>
                    <p class="small text-muted mb-0">
                        <?= htmlspecialchars($proyecto->descripcion) ?>
                    </p>
                    <!--Mostrar el usuario creador del proyecto-->
                    <p class="small text-muted mb-0">
                        <i class="fas fa-user"></i>
                        Creado por: <?= htmlspecialchars($proyecto->usuario->nombre) ?>
                    </p>
                </div>

                <div class="card-body">
                    <div class="row g-3">

                        <?php foreach ($proyecto->tareas as $tarea): ?>
                            <?php
                            $esMia = $tarea->usuario_id == $_SESSION['user_id'];
                            ?>

                            <div class="col-md-4">
                                <div class="card task-card <?= $esMia ? '' : 'task-disabled' ?>">
                                    <div class="card-body p-3">

                                        <div class="d-flex justify-content-between align-items-start">
                                            <strong><?= htmlspecialchars($tarea->titulo) ?></strong>

                                            <?php if ($esMia): ?>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditarTarea<?= $tarea->tarea_id ?>" title="Editar tarea">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>

                                        <p class="small mt-2">
                                            <?= htmlspecialchars($tarea->descripcion) ?>
                                        </p>

                                        <p class="small text-muted mb-1">
                                            <i class="fas fa-user"></i>
                                            <?= htmlspecialchars($tarea->usuario->nombre ?? 'Sin asignar') ?>
                                        </p>

                                        <p class="small text-muted mb-0">
                                            Estado: <strong><?= htmlspecialchars($tarea->estado->nombre) ?></strong>
                                        </p>
                                        <!-- Mostrar comentarios si existen -->
                                        <?php if (!is_null($tarea->comentarios)): ?>
                                            <p class="small text-muted mb-0">
                                                <i class="fas fa-comments"></i>
                                                <?= nl2br(htmlspecialchars($tarea->comentarios)) ?>
                                            </p>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>

                            <!-- MODAL EDITAR TAREA -->
                            <?php if ($esMia): ?>
                                <div class="modal fade" id="modalEditarTarea<?= $tarea->tarea_id ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <form method="POST" action="<?= BASE_URL ?>tarea/editar/<?= $tarea->tarea_id ?>">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Editar tarea · <?= htmlspecialchars($tarea->titulo) ?>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label class="form-label">Comentarios</label>
                                                        <textarea name="comentarios" class="form-control"
                                                            rows="3"><?= htmlspecialchars($tarea->comentarios) ?></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Estado</label>
                                                        <select name="estado_id" class="form-select">
                                                            <?php foreach ($estados as $estado): ?>
                                                                <option value="<?= $estado->estado_id ?>"
                                                                    <?= $estado->estado_id == $tarea->estado_id ? 'selected' : '' ?>>
                                                                    <?= htmlspecialchars($estado->nombre) ?>
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
                                                        <i class="fas fa-save"></i> Guardar
                                                    </button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- FOOTER -->
    <footer class="py-3 bg-light text-center">
        <div class="container">
            <small class="text-muted">© <?= date('Y') ?> ProjectGest</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>