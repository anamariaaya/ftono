<?php
namespace Controllers\Music;

use MVC\Router;
use Model\Albums;
use Model\Genres;
use Model\Sellos;
use Model\Empresa;
use Model\Idiomas;
use Model\Artistas;
use Model\NTMusica;
use Model\AlbumArtista;
use Model\AlbumIdiomas;
use Model\PerfilUsuario;
use Model\UsuarioSellos;
use Model\AlbumArtSecundarios;

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

    public static function consultaAlbumes(){
        //isMusico();
        $id = $_SESSION['id'];
        $albums = Albums::whereAll('id_usuario',$id);
        echo json_encode($albums);
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
        $id = $_SESSION['id'];
        $lang = $_SESSION['lang'] ?? 'en';
        $artistas = Artistas::whereOrdered('id_usuario', $id, 'nombre');
        $usuariosellos = UsuarioSellos::whereAll('id_usuario', $id);
        $sellos = array();
        foreach($usuariosellos as $usuarioSello){
            $sello = Sellos::find($usuarioSello->id_sellos);
            $sellos[] = $sello;
        }

        $titulo = tt('music_albums_new');
        $album = new Albums;
        $idiomas = Idiomas::AllOrderAsc('idioma_en');
        $tipoUsuario = NTMusica::where('id_usuario', $id);
        $alertas = [];
        $albumArtSecundarios = new AlbumArtSecundarios;
        $perfilUsuario = PerfilUsuario::where('id_usuario', $id); 

        if($lang == 'en'){
            $idioma = Idiomas::AllOrderAsc('idioma_en');
        }else{
            $idioma = Idiomas::AllOrderAsc('idioma_es');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $album ->sincronizar($_POST);
            $albumArtSecundarios->artistas = $_POST['art-secundarios'];
            $album->id_usuario = $_SESSION['id'];
            $alertas = $album->validarAlbum();
            
            if(empty($alertas)){
                if($tipoUsuario->id_nivel != 3){
                    if(empty($_POST['sello'])){
                        $empresa = Empresa::where('id', $perfilUsuario->id_empresa);
                        $artista = Artistas::where('id', $_POST['artistas']);
                        $album->sello = $empresa->empresa.' - '.$artista->nombre;
                    }else{
                        $sello = Sellos::where('id', $_POST['sello']);
                        $album->sello = $sello->nombre;
                    }
                }else{
                    $empresa = Empresa::where('id', $perfilUsuario->id_empresa);
                    $album->sello = $empresa->empresa;
                }
    
                //buscar si existe el UPC
                $upc = Albums::where('upc', $_POST['upc']);
                if($upc){
                    $alertas['error'][] = tt('music_albums_upc_exists');
                }
                
                //guardar la imagen de portada en la carpeta de portadas
                $directorio = __DIR__.'/../../public/portadas/';
                if (!is_dir($directorio)) {
                    mkdir($directorio, 0755, true);
                }

                $nombrePortada = null;

                // Check if the file was uploaded successfully
                if (isset($_FILES['portada']) && $_FILES['portada']['error'] === UPLOAD_ERR_OK) {
                    $nombrePortada = md5(uniqid(rand(), true)) . '.jpg';
                    move_uploaded_file($_FILES['portada']['tmp_name'], $directorio . '/' . $nombrePortada);
                    $album->portada = $nombrePortada;
                } else {
                    $album->portada = 'default-cover.webp';
                }

                $album->guardar();

                //Buscar el álbum recién creado
                $album = Albums::where('upc', $_POST['upc']);

                //Asignar el artista principal al album
                $albumArtista = new AlbumArtista;
                $albumArtista->id_albums = $album->id;
                $albumArtista->id_artistas = $_POST['artistas'];
                $albumArtista->guardar();

                if(!empty($_POST['art-secundarios'])){
                    //Asignar los artistas secundarios al album
                    $albumArtSecundarios = new AlbumArtSecundarios;
                    $albumArtSecundarios->id_albums = $album->id;
                    $albumArtSecundarios->artistas = $_POST['art-secundarios'];
                    $albumArtSecundarios->guardar();
                }

                //guardar los idiomas del album
                $idIdiomas = explode(',', $_POST['selectedLanguages']);
                //save each language in the album
                foreach($idIdiomas as $idIdioma){
                    $albumIdioma = new AlbumIdiomas;
                    $albumIdioma->id_album = $album->id;
                    $albumIdioma->id_idioma = $idIdioma;
                    $albumIdioma->guardar();
                }

                header('Location: /music/albums');
            }
        }

        $alertas = Albums::getAlertas();

        $router->render('music/albums/new',[
            'titulo' => $titulo,
            'album' => $album,
            'artistas' => $artistas,
            'idiomas' => $idiomas,
            'lang' => $lang,
            'tipoUsuario' => $tipoUsuario,
            'sellos' => $sellos,
            'alertas' => $alertas,
            'albumArtSecundarios' => $albumArtSecundarios
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