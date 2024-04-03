<?php

namespace Controllers\Filmtono;

use MVC\Router;
use Model\Categorias;

class CategoriesController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'categories_main-title';
        $categorias = Categorias::All();
        $router->render('/admin/categories/index',[
            'titulo' => $titulo,
            'categorias' => $categorias
        ]);
    }

    public static function consultarCategorias(){
        $categorias = Categorias::allOrderAsc('id');
        echo json_encode($categorias);
    }
}