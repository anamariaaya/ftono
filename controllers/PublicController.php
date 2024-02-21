<?php

namespace Controllers;

use MVC\Router;
use Model\Promos;

class PublicController{

    public static function index(Router $router){
        $inicio = true;
        $titulo = 'index';
        $promos = Promos::AllOrderDesc('id');

        $router->render('/paginas/index',[
            'inicio' => $inicio,
            'titulo' => 'home_title',
            'promos' => $promos
        ]);
    }

    public static function category(Router $router){
        $titulo = 'Categoría';
        $router->render('/paginas/category',[
            'titulo' => $titulo
        ]);
    }

    public static function search(Router $router){
        $titulo = 'Buscar';
        $router->render('/paginas/search',[
            'titulo' => $titulo
        ]);
    }

    public static function cart(Router $router){
        $titulo = 'Carrito';
        $router->render('/paginas/cart',[
            'titulo' => 'home_title'
        ]);
    }

    public static function categories(Router $router){
        $titulo = 'Categorias';
        $router->render('/paginas/categories',[
            'titulo' => $titulo
        ]);
    }

    public static function help(Router $router){
        $titulo = 'Ayuda';
        $router->render('/paginas/help',[
            'titulo' => $titulo
        ]);
    }

    public static function faq(Router $router){
        $titulo = 'FAQ';
        $router->render('/paginas/faq',[
            'titulo' => $titulo
        ]);
    }

    public static function artists(Router $router){
        $titulo = 'Artistas';
        $router->render('/paginas/artists',[
            'titulo' => $titulo
        ]);
    }
}