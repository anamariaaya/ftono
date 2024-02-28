<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\NTMusica;

class DashboardController{
    public static function admin(Router $router){
        isAdmin();
        $titulo = 'dashboard-title';
        $router->render('/admin/dashboard',[
            'titulo' => 'dashboard-title',
        ]);
    }

    public static function clients(Router $router){        
        isComprador();
        $usuario = Usuario::find($_SESSION['id']);

        $titulo = 'dashboard-title';
        $router->render('clients/dashboard',[
            'titulo' => $titulo,
            'usuario' => $usuario
        ]);
    }

    public static function music(Router $router){
        isMusico();
        $usuario = Usuario::find($_SESSION['id']);
        $nivel = NTMusica::where('id_usuario', $_SESSION['id']);

        $titulo = 'dashboard-title';
        $router->render('music/dashboard',[
            'titulo' => 'dashboard-title',
            'nivel' => $nivel
        ]);
    }
}