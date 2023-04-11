<?php

namespace Controllers\Music;

use MVC\Router;
use Model\Usuario;

class MusicProfileController{
    public static function index(Router $router){
        isMusico();
        $usuario = Usuario::find($_SESSION['id']);

        $titulo = tt('t-profile');
        $router->render('music/profile/index',[
            'titulo' => $titulo,
            'usuario' => $usuario
        ]);
    }
}