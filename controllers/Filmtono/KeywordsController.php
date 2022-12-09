<?php

namespace Controllers\Filmtono;

use MVC\Router;

class KeywordsController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'Keywords';
        $router->render('/admin/keywords/index',[
            'titulo' => $titulo
        ]);
    }
}