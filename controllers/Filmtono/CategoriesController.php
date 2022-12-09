<?php

namespace Controllers\Filmtono;

use MVC\Router;

class CategoriesController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'Categories';
        $router->render('/admin/categories/index',[
            'titulo' => $titulo
        ]);
    }
}