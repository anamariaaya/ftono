<?php

namespace Controllers\Filmtono;

use MVC\Router;

class UsersController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'Users';
        $router->render('/admin/users/index',[
            'titulo' => $titulo
        ]);
    }
}