<?php

namespace Controllers\Filmtono;

use MVC\Router;

class ArtistsController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'Artists';
        $router->render('/admin/artists/index',[
            'titulo' => $titulo
        ]);
    }
}