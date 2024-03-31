<?php

namespace Controllers\Filmtono;

use MVC\Router;
use Model\Empresa;
use Model\NTAdmin;
use Model\Usuario;
use Model\NTMusica;
use Model\TipoMusica;
use Model\PerfilUsuario;

class UsersController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'users_main_title';
        $usuarios = Usuario::All();
        $router->render('/admin/users/index',[
            'titulo' => $titulo,
            'usuarios' => $usuarios
        ]);
    }

    public static function current(Router $router){
        isAdmin();
        $titulo = 'users_main-title';
        $id = s($_GET['id']);
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $empresa = null;
        $ntadmin = null;
        $ntmusica = null;
        $tipoMusica = null;
        $usuario = Usuario::find($id);
        $perfilUsuario = PerfilUsuario::where('id_usuario', $id);
        if($perfilUsuario !== null){
            $empresa = Empresa::find($perfilUsuario->id_empresa);
        }
        $ntadmin = NTAdmin::where('id_usuario', $id);
        $ntmusica = NTMusica::where('id_usuario', $id);
        if($ntmusica !== null){
            $tipoMusica = TipoMusica::find($ntmusica->id_musica);
        }

        $router->render('/admin/users/current',[
            'titulo' => $titulo,
            'usuario' => $usuario,
            'empresa' => $empresa,
            'ntadmin' => $ntadmin,
            'ntmusica' => $ntmusica,
            'tipoMusica' => $tipoMusica
        ]);
    }

    public static function new(Router $router){
        isAdmin();
        $titulo = 'users_new_title';
        $router->render('/admin/users/new',[
            'titulo' => $titulo
        ]);
    }

    public static function delete(){
        isAdmin();
        $id = s($_GET['id']);
        $id = filter_var($id, FILTER_VALIDATE_INT);
        debugging($id);
    }
}