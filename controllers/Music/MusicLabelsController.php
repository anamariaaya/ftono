<?php

namespace Controllers\Music;

use MVC\Router;
use Model\Sellos;

class MusicLabelsController{
    public static function index(Router $router){
        isMusico();
        $sellos = Sellos::all();

        $titulo = tt('t-labels');
        $router->render('music/labels/index',[
            'titulo' => $titulo,
            'sellos' => $sellos
        ]);
    }
}