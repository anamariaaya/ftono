<?php
namespace Controllers\Filmtono;

use MVC\Router;
use Model\Genres;

class GenresController{
    public static function index(Router $router){
        isAdmin();
        $lang = $_SESSION['lang'] ?? 'en';
        $generos = Genres::allOrderAsc('genero_'.$lang);

        $router->render('/admin/genres/index',[
            'titulo' => 'admin_genres_title',
            'generos' => $generos,
            'lang' => $lang
        ]);
    }

    public static function new(Router $router){
        isAdmin();
        $genero = new Genres;
        $titulo = 'admin_genres_new_title';
        $router->render('/admin/genres/new',[
            'titulo' => $titulo,
            'genero' => $genero
        ]);
    }

    public static function edit(Router $router){
        isAdmin();
        $id = redireccionar('/admin/genres');
        $genero = Genres::find($id);
        $titulo = 'admin_genres_edit_title';
        $router->render('/admin/genres/edit',[
            'titulo' => $titulo,
            'genero' => $genero
        ]);
    }

    public static function delete(){
        isAdmin();
        $id = redireccionar('/admin/genres');
        $genero = Genres::find($id);
        $genero->eliminar();
        header('Location: /admin/genres');
    }
}