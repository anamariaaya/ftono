<?php

namespace Controllers;

use MVC\Router;

class DashboardController{
    public static function index(Router $router){ 
        isAdmin();
        $titulo = 'Dashboard';
        $router->render('/admin/dashboard',[
            'titulo' => $titulo
        ]);
    }

    public static function compras(Router $router){        
        isComprador();
        $titulo = 'Dashboard';
        $router->render('compras/dashboard',[
            'titulo' => $titulo
        ]);
    }

    public static function musica(Router $router){
        isMusico();        
        $titulo = 'Dashboard';
        $router->render('musica/dashboard',[
            'titulo' => $titulo
        ]);
    }
}