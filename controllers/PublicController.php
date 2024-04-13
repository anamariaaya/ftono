<?php

namespace Controllers;

use MVC\Router;
use Model\Genres;
use Model\Promos;
use Model\Categorias;

class PublicController{

    public static function index(Router $router){
        $inicio = true;
        $titulo = 'home_title';
        $promos = Promos::AllOrderDesc('id');

        $router->render('/paginas/index',[
            'inicio' => $inicio,
            'titulo' => $titulo,
            'promos' => $promos
        ]);
    }

    public static function categories(Router $router){
        $titulo = 't-categories';
        $router->render('/paginas/categories',[
            'titulo' => $titulo
        ]);
    }

    public static function consultarCategorias(){
        $categorias = Categorias::allOrderAsc('id');
        echo json_encode($categorias);
    }

    public static function genres(Router $router){
        $titulo = 'Géneros';
        $router->render('/paginas/genres',[
            'titulo' => $titulo
        ]);
    }

    public static function consultarGeneros(){
        $generos = Genres::allOrderAsc('id');
        echo json_encode($generos);
    }

    public static function category(Router $router){
        $titulo = 't-category';
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