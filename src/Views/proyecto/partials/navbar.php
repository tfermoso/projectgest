  <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand fw-bold" href="/">ProjectGest</a>

            <!-- BOTÓN HAMBURGUESA -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarProjectGest"
                aria-controls="navbarProjectGest" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MENÚ COLAPSABLE -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarProjectGest">
                <ul class="navbar-nav align-items-center">

                    <li class="nav-item me-2">
                        <a href="<?= BASE_URL ?>proyecto/nuevo" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Nuevo Proyecto
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>tarea" class="nav-link">Tareas</a>
                    </li>

                    <!-- Usuario logueado -->
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