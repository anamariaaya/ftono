<?php

namespace Controllers;

use MVC\Router;

class DashboardController{
    public static function index(Router $router){
        session_start();
        $titulo = 'Dashboard';
        $router->render('/admin/dashboard',[
            'titulo' => $titulo
        ]);
    }
}