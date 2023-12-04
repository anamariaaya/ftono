<?php
namespace Controllers\Music;

use MVC\Router;
use Model\Albums;
use Model\Genres;
use Model\Artistas;
use Model\AlbumArtista;

class MusicAlbumsController{
    public static function index(Router $router){
        isMusico();
        $albums = Albums::whereAll('id_usuario',$_SESSION['id']);
        $titulo = 'music_main_title';
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
        $artistas = Artistas::AllOrderAsc('nombre');
        $titulo = tt('music_albums_new');
        $album = new Albums();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
           
            $album ->sincronizar($_POST);
            $album->id_usuario = $_SESSION['id'];
            debugging($album);
            $album->guardar();

            //Buscar el álbum recién creado
            $album = Albums::where('id', $_POST['id']);
            if($_POST['artistas']){
                $artista = Artistas::where('nombre', $_POST['artistas']);
                if($artista == null || !$artista || $artista == ''){
                    $artista = new Artistas();
                    $artista->nombre = $_POST['artistas'];
                    $artista->guardar();

                    //Asignar el artista al album
                    $artista = Artistas::where('nombre', $_POST['artistas']);
                    $albumArtista = new AlbumArtista();
                    $albumArtista->id_albums = $album->id;
                    $albumArtista->id_artistas = $artista->id;
                    $albumArtista->guardar();
                } else{
                    $albumArtista = new AlbumArtista();
                    $albumArtista->id_albums = $album->id;
                    $albumArtista->id_artistas = $artista->id;
                    $albumArtista->guardar();
                }
            }
            if($_POST['art-secundarios']){
                $idSecundarios = explode(',', $_POST['art-secundarios']);
                //save each artist in the album
                foreach($idSecundarios as $idSecundario){
                    $albumArtista = new AlbumArtista();
                    $albumArtista->id_albums = $album->id;
                    $albumArtista->id_artistas = $idSecundario;
                    $albumArtista->guardar();
                }
            }
            
            // header('Location: /music/albums');
        }

        $router->render('music/albums/new',[
            'titulo' => $titulo,
            'album' => $album,
            'artistas' => $artistas
        ]);
    }

    public static function update(Router $router){
        isMusico();
        $titulo = tt('music_albums_edit');
        $router->render('music/albums/edit',[
            'titulo' => $titulo
        ]);
    }

    public static function newSong(Router $router){
        isMusico();
        $lang = $_SESSION['lang'] ?? 'en';
        $generos = Genres::AllOrderAsc('genero_'.$_SESSION['lang']);
        $titulo = tt('music_songs_new');
        $albumId = redireccionar('/music/albums');
        $album = Albums::find($albumId);
        if(!$album){
            header('Location: /music/albums');
        }
        $router->render('music/albums/song/new',[
            'titulo' => $titulo,
            'album' => $album,
            'generos' => $generos,
            'lang' => $lang
        ]);
    }
}