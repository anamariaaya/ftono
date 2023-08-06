<?php
namespace Controllers\Music;

use MVC\Router;
use Model\Albums;

class MusicAlbumsController{
    public static function index(Router $router){
        isMusico();
        $albums = Albums::whereAll('id_usuario',$_SESSION['id']);
        $titulo = 'music_main-title';
        $router->render('music/albums/index',[
            'titulo' => $titulo,
            'albums' => $albums
        ]);
    }

    public static function current(Router $router){
        isMusico();
        $albumId = redireccionar('/music/albums');
        $album = Albums::find($albumId);
        if(!$album){
            header('Location: /music/albums');
        }
        $titulo = $album->titulo;
        $router->render('music/albums/current',[
            'titulo' => $titulo,
            'album' => $album
        ]);
    }

    public static function new(Router $router){
        isMusico();
        $titulo = tt('music_albums_new');
        $router->render('music/albums/new',[
            'titulo' => $titulo
        ]);
    }

    public static function update(Router $router){
        isMusico();
        $titulo = tt('music_albums_edit');
        $router->render('music/albums/update',[
            'titulo' => $titulo
        ]);
    }
}