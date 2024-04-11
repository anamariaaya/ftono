<?php

namespace Controllers\Filmtono;

use MVC\Router;
use Model\Sellos;
use Model\Usuario;
use Model\NTMusica;
use Model\PerfilUsuario;
use Model\UsuarioSellos;

class LabelsController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'music_labels-title';
        $ntmusica = NTMusica::all();

        $userIds = [];
        $usuarios = Usuario::innerJoin('usuarios','n_t_musica','id', 'id_usuario');

        foreach ($usuarios as $usuario) {

            $userIds[] = $usuario->id;
        }
        $userIdsString = implode(',', $userIds);

        $consultaSellos = "SELECT usuario_sellos.*
        FROM usuario_sellos
        INNER JOIN usuarios
        ON usuario_sellos.id_usuario = usuarios.id  WHERE usuarios.id IN (".$userIdsString.");";

        $perfilUsuario = UsuarioSellos::consultarSQL($consultaSellos);
        

        debugging($perfilUsuario);
        $router->render('/admin/labels/index',[
            'titulo' => $titulo
        ]);
    }
}