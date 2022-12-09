<?php

namespace Controllers;

use MVC\Router;
use Model\Empresa;
use Model\Usuario;

class DashboardController{
    public static function compras(Router $router){        
        isComprador();
        $usuario = Usuario::find($_SESSION['id']);

        $titulo = 'Dashboard';
        $router->render('compras/dashboard',[
            'titulo' => $titulo,
            'usuario' => $usuario
        ]);
    }

    public static function musica(Router $router){
        isMusico();
        $usuario = Usuario::find($_SESSION['id']);

        $titulo = 'Dashboard';
        $router->render('music/dashboard',[
            'titulo' => $titulo,
            'usuario' => $usuario
        ]);
    }
}