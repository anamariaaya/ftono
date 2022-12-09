<?php

namespace Controllers\Filmtono;

use MVC\Router;

class ContractsController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'Contracts';
        $router->render('/admin/contracts/index',[
            'titulo' => $titulo
        ]);
    }
}