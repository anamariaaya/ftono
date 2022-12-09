<?php

namespace Controllers\Filmtono;

use MVC\Router;

class LabelsController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'Labels';
        $router->render('/admin/labels/index',[
            'titulo' => $titulo
        ]);
    }
}