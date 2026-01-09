<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Usuario;
use App\Models\Proyecto;
use App\Models\Tarea;

class ProyectoController extends Controller
{
    public function index(): void
    {
        //Leer todos los proyectos del usuario autenticado
        $proyectos = Proyecto::where('usuario_id', $_SESSION['user_id'])->get();
        $usuarios = Usuario::all();
        $this->view('proyecto/index', ['proyectos' => $proyectos, 'usuarios' => $usuarios]);
    }
    public function nuevo(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $fecha_inicio = $_POST['fecha_inicio'] ?? '';
            $fecha_fin = $_POST['fecha_fin'] ?? '';

            // Crear el proyecto
            Proyecto::create([
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
                'usuario_id' => $_SESSION['user_id']
            ]);

            // Redirigir a la lista de proyectos
            header('Location: ' . BASE_URL . 'proyecto');
            exit;
        }
        $this->view('proyecto/nuevo', []);
    }
    public function editar(int $id): void
    {
        //procesar formulario de edición
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $fecha_inicio = $_POST['fecha_inicio'] ?? '';
            $fecha_fin = $_POST['fecha_fin'] ?? '';

            //Actualizar el proyecto
            $proyecto = Proyecto::find($id);
            if ($proyecto && $proyecto->usuario_id === $_SESSION['user_id']) {
                $proyecto->titulo = $titulo;
                $proyecto->descripcion = $descripcion;
                $proyecto->fecha_inicio = $fecha_inicio;
                $proyecto->fecha_fin = $fecha_fin;
                $proyecto->save();

                //Redirigir a la lista de proyectos
                header('Location: ' . BASE_URL . 'proyecto');
                exit;
            }
        }
        //Editar proyecto por id
        $proyecto = Proyecto::find($id);
        if (!$proyecto || $proyecto->usuario_id !== $_SESSION['user_id']) {
            header('Location: ' . BASE_URL . 'proyecto');
            exit;
        }
        $this->view('proyecto/editar', ['proyecto' => $proyecto]);
    }
    public function eliminar(int $id): void
    {
        //eliminar proyecto por id
        $proyecto = Proyecto::find($id);
        if ($proyecto && $proyecto->usuario_id === $_SESSION['user_id']) {
            $proyecto->delete();
            $_SESSION['success'] = "Proyecto eliminado correctamente.";
            header('Location: ' . BASE_URL . 'proyecto');
        }   
    }

    public function nuevatarea(int $proyecto_id): void
    {
        //Agregar nueva tarea a un proyecto
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $usuario_id = $_POST['usuario_id'] ?? '';

            // Crear la tarea
            Tarea::create([
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'proyecto_id' => $proyecto_id,
                'usuario_id' => $usuario_id,
                'estado_id' => 1
            ]);

            // Redirigir a la vista de tareas del proyecto
            header('Location: ' . BASE_URL . 'proyecto');
            exit;
        }
    }
    public function eliminarTarea(int $tarea_id): void
    {
        $tarea = Tarea::find($tarea_id);
        if ($tarea && $tarea->proyecto->usuario_id === $_SESSION['user_id']) {
            $tarea->delete();
        }
        $_SESSION['success'] = "Tarea eliminada correctamente.";
        header('Location: ' . BASE_URL . 'proyecto');
    }
    public function editarTarea(int $proyecto_id, int $tarea_id): void
    {

    }


}
