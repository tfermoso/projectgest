<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Usuario;
use App\Models\Tarea;
use App\Models\Estado;
use App\Models\Proyecto;

class TareaController extends Controller
{
    public function index(): void
    {
        //listar tareas assignadas al usuario autenticado
        $tareasPorProyecto = Proyecto::with(['tareas.usuario', 'tareas.estado'])
            ->whereHas('tareas', function ($q) {
                $q->where('usuario_id', $_SESSION['user_id']);
            })
            ->get();

        $estados = Estado::all();


        $this->view('tarea/index', ['tareasPorProyecto' => $tareasPorProyecto, 'estados' => $estados]);
    }

    public function editar(int $id): void
    {
        //procesar formulario de edición
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Comprobar tarea asignada al usuario
            if (!Tarea::where('tarea_id', $id)->where('usuario_id', $_SESSION['user_id'])->exists()) {
                header('Location: ' . BASE_URL . 'tarea');
                exit;
            }
            
            $estado_id = $_POST['estado_id'] ?? null;

            //Actualizar la tarea
            $tarea = Tarea::find($id);
            if ($tarea && $tarea->usuario_id === $_SESSION['user_id']) {
                $tarea->comentarios = $_POST['comentarios'] ?? '';
                $tarea->estado_id = $estado_id;
                $tarea->save();
            }

            // Redirigir a la lista de tareas
            header('Location: ' . BASE_URL . 'tarea');
            exit;
        }
    }

}