<?php
namespace Controllers\Music;

use MVC\Router;
use Model\Albums;
use Model\Genres;
use Model\Artistas;
use Model\AlbumArtista;

class MusicArtistsController{
    public static function index(Router $router){
        isMusico();
        $titulo = 'artists_main-title';
        $router->render('music/artists/index',[
            'titulo' => $titulo,
        ]);
    }

    public static function new(Router $router){
        isMusico();
        $titulo = 'artists_new-title';
        $alertas = [];
        $router->render('music/artists/new',[
            'titulo' => $titulo,
            'alertas' => $alertas
        ]);
    }

    public static function edit(Router $router){
        isMusico();
        $titulo = 'artists_edit-title';
        $alertas = [];
        $router->render('music/artists/edit',[
            'titulo' => $titulo,
            'alertas' => $alertas
        ]);
    }

    // public static function current(Router $router){
    //     isMusico();
    //     $albumId = redireccionar('/music/albums');
    //     $album = Albums::find($albumId);
    //     if(!$album){
    //         header('Location: /music/albums');
    //     }
    //     $titulo = $album->titulo;
    //     $router->render('music/albums/current',[
    //         'titulo' => $titulo,
    //         'album' => $album
    //     ]);
    // }


    // public static function update(Router $router){
    //     isMusico();
    //     $titulo = tt('music_albums_edit');
    //     $router->render('music/albums/edit',[
    //         'titulo' => $titulo
    //     ]);
    // }

    // public static function newSong(Router $router){
    //     isMusico();
    //     $lang = $_SESSION['lang'] ?? 'en';
    //     $generos = Genres::AllOrderAsc('genero_'.$_SESSION['lang']);
    //     $titulo = tt('music_songs_new');
    //     $albumId = redireccionar('/music/albums');
    //     $album = Albums::find($albumId);
    //     if(!$album){
    //         header('Location: /music/albums');
    //     }
    //     $router->render('music/albums/song/new',[
    //         'titulo' => $titulo,
    //         'album' => $album,
    //         'generos' => $generos,
    //         'lang' => $lang
    //     ]);
    // }
}