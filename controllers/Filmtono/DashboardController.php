<?php

namespace Controllers\Filmtono;

use MVC\Router;

class DashboardController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'Dashboard';
        $router->render('/admin/dashboard',[
            'titulo' => $titulo
        ]);
    }
}