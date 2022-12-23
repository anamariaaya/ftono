<?php

namespace Controllers\Clients;

use MVC\Router;
use Model\Usuario;

class ClientProfileController{
    public static function profile(Router $router){
        isComprador();
        $usuario = Usuario::find($_SESSION['id']);

        $titulo = 'Dashboard';
        $router->render('clients/dashboard',[
            'titulo' => $titulo,
            'usuario' => $usuario
        ]);
    }
}