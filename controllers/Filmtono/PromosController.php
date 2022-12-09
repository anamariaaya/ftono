<?php

namespace Controllers\Filmtono;

use MVC\Router;

class PromosController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'Promos';
        $router->render('/admin/promos/index',[
            'titulo' => $titulo
        ]);
    }
}