<?php

namespace Controllers\Music;

use MVC\Router;
use Model\Usuario;

class MusicProfileController{
    public static function profile(Router $router){
        isMusico();
        $usuario = Usuario::find($_SESSION['id']);

        $titulo = 'Profile';
        $router->render('music/profile',[
            'titulo' => $titulo,
            'usuario' => $usuario
        ]);
    }
}