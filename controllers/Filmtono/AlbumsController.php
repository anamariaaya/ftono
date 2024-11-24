<?php

namespace Controllers\Filmtono;

use MVC\Router;
use Model\Albums;
use Model\Idiomas;
use Model\Artistas;
use Model\AlbumArtista;
use Model\AlbumIdiomas;
use Model\AlbumArtSecundarios;
use Model\UsuarioAlbumArtista;

class AlbumsController{
    public static function index(Router $router){
        isAdmin();
        $albums = Albums::all();
        $titulo = 'music_main_title';
        $router->render('admin/albums/index',[
            'titulo' => $titulo,
            'albums' => $albums
        ]);
    }

    public static function consultaAlbumes(){
        //isAdmin();
        $albums = 'SELECT 
            al.*,
            ar.id AS artista_id,
            ar.nombre AS artista_name
        FROM 
            albums al
        LEFT JOIN 
            album_artistas aa ON al.id = aa.id_albums
        LEFT JOIN 
            artistas ar ON aa.id_artistas = ar.id
        ORDER BY 
            al.id DESC;
        ';
        $albums = UsuarioAlbumArtista::consultarSQL($albums);
        echo json_encode($albums);
    }

    public static function current(Router $router){
        isAdmin();
        $albumId = redireccionar('/filmtono/albums');
        $album = Albums::find($albumId);
        $artistaId = AlbumArtista::where('id_albums',$album->id);
        $artista = Artistas::find($artistaId->id_artistas);
        $art_secundarios = AlbumArtSecundarios::where('id_albums',$album->id);
        $albumIdiomas = AlbumIdiomas::whereAll('id_album', $album->id);
        $idiomas = [];
        //debugging($albumIdiomas);
        foreach($albumIdiomas as $albumIdioma){
            $idioma = Idiomas::find($albumIdioma->id_idioma);
            $idiomas[] = $idioma;
            //convertir el array de idiomas en un string
        }
        //convertir el objeto de idiomas en array
        $idiomas = array_map(function($idioma){
            $lang = $_SESSION['lang'] ?? 'en';
            if($lang === 'es'){
                return $idioma->idioma_es;
            }else{
                return $idioma->idioma_en;
            }
        }, $idiomas);

        $idiomas = implode(', ', $idiomas);

        $songs = [];
        if(!$album){
            header('Location: /music/albums');
        }
        $titulo = 'artist_title';
        $router->render('admin/albums/current',[
            'titulo' => $titulo,
            'album' => $album,
            'songs' => $songs,
            'artista' => $artista,
            'art_secundarios' => $art_secundarios,
            'idiomas' => $idiomas
        ]);
    }

    public static function delete(Router $router){
        isAdmin();
        redireccionar('/filmtono/albums');
        $albumId = redireccionar('/filmtono/albums');
        $album = Albums::find($albumId);
        $resultado = $album->eliminar();
        if($resultado){
            header('Location: /filmtono/albums');
        }
    }
}