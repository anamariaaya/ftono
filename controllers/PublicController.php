<?php

namespace Controllers;

use MVC\Router;
use Model\Genres;
use Model\Promos;
use Model\Keywords;
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
        $lang = $_SESSION['lang'];
        $id = s($_GET['id']) ?? null;
        $categoria = Categorias::find($id);
        if(!$categoria){
            header('Location: /categories');
        } else if($lang == 'es'){
            $categoria = $categoria->categoria_es;
        } else {
            $categoria = $categoria->categoria_en;
        }
        $router->render('/paginas/category',[
            'titulo' => $titulo,
            'categoria' => $categoria
        ]);
    }

    public static function consultarCategory(){
        $id = $_GET['id'] ?? null;
        if(!$id){
            header('Location: /categories');
        }else{
            $consulta = "SELECT k.id AS id, k.keyword_en, k.keyword_es, c.id AS id_categoria FROM keywords AS k LEFT JOIN categ_keyword AS w ON k.id = w.id_keyword LEFT JOIN categorias AS c ON w.id_categoria = c.id WHERE c.id = ".$id.";";
            $keywords = Keywords::consultarSQL($consulta);
        }
        echo json_encode($keywords);
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