<?php

namespace Controllers\Filmtono;

use MVC\Router;

class AlbumsController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'Albums';
        $router->render('/admin/albums/index',[
            'titulo' => $titulo
        ]);
    }
}