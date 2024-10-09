<?php

namespace Controllers;

use MVC\Router;
use Model\Genres;
use Model\Promos;
use Model\Artistas;
use Model\Keywords;
use Model\Categorias;

class PublicController{

    public static function index(Router $router){
        $inicio = true;
        $titulo = 'home_title';
        $promos = Promos::AllOrderDesc('id');
        $artists = Artistas::getOrdered('4', 'id', 'DESC');

        $router->render('/paginas/index',[
            'inicio' => $inicio,
            'titulo' => $titulo,
            'promos' => $promos,
            'artists' => $artists
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
        $id = $_GET['id'] ?? null;
        if($id){
            $id = filter_var($id, FILTER_VALIDATE_INT);
        }
        $name = $_GET['name'] ?? null;
        if($id !== null){
            $categoria = Categorias::find($id);
        } elseif($name !== null){
            $categoria = Categorias::where('categoria_en',$name);
        } else {
           header('Location: /categories');
        }
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
        $name = $_GET['name'] ?? null;
        $categoria = Categorias::where('categoria_en',$name);
        $id = $_GET['id'] ?? $categoria->id;
        if(!$name && !$id){
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
        $titulo = 'artists_title';
        $artists = Artistas::all();
        $router->render('/paginas/artists',[
            'titulo' => $titulo,
            'artists' => $artists
        ]);
    }

    public static function consultarArtistas(){
        $artists = Artistas::all();
        echo json_encode($artists);
    }

    public static function artist(Router $router){
        $id = redireccionar('/artists');
        $artista = Artistas::find($id);
        $titulo = 'artist_title';
        $router->render('/paginas/artist',[
            'titulo' => $titulo,
            'artista' => $artista
        ]);
    }
}