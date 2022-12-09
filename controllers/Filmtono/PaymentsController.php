<?php

namespace Controllers\Filmtono;

use MVC\Router;

class PaymentsController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'Payments';
        $router->render('/admin/payments/index',[
            'titulo' => $titulo
        ]);
    }
}