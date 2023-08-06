<?php

namespace Controllers\Music;

use MVC\Router;
use Model\Sellos;
use Model\Usuario;
use Model\UsuarioSellos;

class MusicLabelsController{
    public static function index(Router $router){
        isMusico();
        $usuario = Usuario::find($_SESSION['id']);
        $usuarioId = $usuario->id;
        $consulta = 'SELECT sellos.id, sellos.nombre, sellos.creado FROM sellos INNER JOIN usuario_sellos ON sellos.id = usuario_sellos.id_sellos INNER JOIN usuarios ON usuario_sellos.id_usuario = usuarios.id WHERE usuarios.id =' . $usuarioId .' ORDER BY sellos.nombre ASC';

        $sellos = Sellos::consultarSQL($consulta);
        //debugging($consulta);

        $titulo = 'music_labels-title';
        $router->render('music/labels/index',[
            'titulo' => $titulo,
            'sellos' => $sellos
        ]);
    }

    public static function new(Router $router){
        isMusico();
        $sellos = new Sellos();
        $usuario = Usuario::find($_SESSION['id']);
        $titulo = 'music_labels_new-title';
        $alertas = Sellos::getAlertas();
        $usuarioSellos = new UsuarioSellos();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $sellos = new Sellos($_POST);
            $alertas = $sellos->validarSello();
            if(empty($alertas)){
                $sellos->guardar();
                $sellos = Sellos::where('nombre', $sellos->nombre);
                $usuarioSellos->id_usuario = $usuario->id;
                $usuarioSellos->id_sellos = $sellos->id;
                $usuarioSellos->guardar();
            }
            header('Location: /music/labels');
        }        

        $router->render('music/labels/new',[
            'titulo' => $titulo,
            'alertas' => $alertas,
            'sellos' => $sellos
        ]);
    }

    public static function update(Router $router){
        isMusico();
        $id = redireccionar('/music/labels');
        $sellos = Sellos::find($id);
        $titulo = 'music_labels_edit-title';
        $alertas = Sellos::getAlertas();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $args = $_POST;
            $sellos->sincronizar($args);
            $alertas = $sellos->validarSello();

            if(empty($alertas)){
                $sellos->guardar();
            }
            header('Location: /music/labels');
        }

        $router->render('music/labels/update',[
            'titulo' => $titulo,
            'sellos' => $sellos,
            'alertas' => $alertas
        ]);
    }

    public static function delete(){
        isMusico();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id){
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    $sellos = Sellos::find($id);
                    $sellos->eliminar();
                }
            }
        }
    }
}