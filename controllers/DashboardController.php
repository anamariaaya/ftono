<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

class DashboardController{
    public static function admin(Router $router){
        isAdmin();
        $titulo = 'Dashboard';
        $router->render('/admin/dashboard',[
            'titulo' => $titulo
        ]);
    }

    public static function clients(Router $router){        
        isComprador();
        $usuario = Usuario::find($_SESSION['id']);

        $titulo = 'Dashboard';
        $router->render('clients/dashboard',[
            'titulo' => $titulo,
            'usuario' => $usuario
        ]);
    }

    public static function music(Router $router){
        isMusico();
        $usuario = Usuario::find($_SESSION['id']);

        $titulo = 'Dashboard';
        $router->render('music/dashboard',[
            'titulo' => $titulo,
            'usuario' => $usuario
        ]);
    }
}