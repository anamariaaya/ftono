<?php
namespace Controllers\Music;

use MVC\Router;
use Model\Albums;
use Model\Genres;
use Model\Sellos;
use Model\Empresa;
use Model\Idiomas;
use Model\Artistas;
use Model\Keywords;
use Model\NTMusica;
use Model\Canciones;
use Model\Categorias;
use Model\AlbumArtista;
use Model\AlbumIdiomas;
use Model\CancionColab;
use Model\NivelCancion;
use Model\PerfilUsuario;
use Model\UsuarioSellos;
use Model\AlbumArtSecundarios;
use Model\UsuarioAlbumArtista;

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
        isMusico();
        $id = $_SESSION['id'];
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
        WHERE 
            al.id_usuario = '.$id.'
        ORDER BY 
            al.id DESC;
        ';
        $albums = UsuarioAlbumArtista::consultarSQL($albums);
        echo json_encode($albums);
    }

    public static function current(Router $router){
        isMusico();
        $albumId = redireccionar('/music/albums');
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
        $router->render('music/albums/current',[
            'titulo' => $titulo,
            'album' => $album,
            'songs' => $songs,
            'artista' => $artista,
            'art_secundarios' => $art_secundarios,
            'idiomas' => $idiomas
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

        $titulo = 'music_albums_new';
        $album = new Albums;
        $idiomas = Idiomas::AllOrderAsc('idioma_en');
        $tipoUsuario = NTMusica::where('id_usuario', $id);
        $alertas = [];
        $albumArtSecundarios = new AlbumArtSecundarios;
        $perfilUsuario = PerfilUsuario::where('id_usuario', $id); 
        $selectedLanguages = [];
        $selectedArtistId = null;

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
            //debugging($_POST);
            if (!isset($_POST['artistas']) || $_POST['artistas'] === '0' || trim($_POST['artistas']) === '') {
                $alertas = Artistas::setAlerta('error', 'music_albums_artist_alert-required');
            }
            $alertas = Artistas::getAlertas();
            //debugging($alertas);

            if(empty($_POST['selectedLanguages'])){
                Idiomas::setAlerta('error','music_albums_languages_alert-required');
            }
            $alertas = Idiomas::getAlertas();
            
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
            'albumArtSecundarios' => $albumArtSecundarios,
            'selectedLanguages' => $selectedLanguages,
            'selectedArtistId' => $selectedArtistId
        ]);
    }

    public static function edit(Router $router){
        isMusico();
        $id = $_SESSION['id'];
        $lang = $_SESSION['lang'] ?? 'en';
        $titulo = 'music_albums_edit-title';
        $albumId = redireccionar('/music/albums');
        $album = Albums::find($albumId);
        $idiomas = Idiomas::AllOrderAsc('idioma_en');
        $albumArtista = AlbumArtista::where('id_albums',$album->id);
        $albumIdiomas = AlbumIdiomas::whereAll('id_album', $album->id);

        $albumArtSecundarios = AlbumArtSecundarios::where('id_albums',$album->id);
        $artistas = Artistas::whereOrdered('id_usuario', $id, 'nombre');
        $selectedArtist = AlbumArtista::where('id_albums',$album->id);
        $selectedArtistId = $selectedArtist->id_artistas;

        $albumIdiomas = AlbumIdiomas::whereAll('id_album', $album->id);
        $selectedLanguages = []; // This should be fetched based on the album ID
        foreach ($albumIdiomas as $albumIdioma) {
            $selectedLanguages[] = $albumIdioma->id_idioma; // Assuming $albumIdiomas contains records related to the current album
        }

        $usuariosellos = UsuarioSellos::whereAll('id_usuario', $id);
        $sellos = array();
        foreach($usuariosellos as $usuarioSello){
            $sello = Sellos::find($usuarioSello->id_sellos);
            $sellos[] = $sello;
        }
        $tipoUsuario = NTMusica::where('id_usuario', $id);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $album ->sincronizar($_POST);
            $albumArtSecundarios->artistas = $_POST['art-secundarios'];
            $album->id_usuario = $_SESSION['id'];
            $alertas = $album->validarAlbum();
            $perfilUsuario = PerfilUsuario::where('id_usuario', $id); 

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

                $directorio = __DIR__.'/../../public/portadas/';
                if (!is_dir($directorio)) {
                    mkdir($directorio, 0755, true);
                }
                
                $albumOld = Albums::find($albumId);
                $nombrePortada = null;

                if (isset($_FILES['portada']) && $_FILES['portada']['error'] === UPLOAD_ERR_OK) {
                    $nombrePortada = md5(uniqid(rand(), true)) . '.jpg';
                    move_uploaded_file($_FILES['portada']['tmp_name'], $directorio . '/' . $nombrePortada);
                    $album->portada = $nombrePortada;
                    //Eliminar portada anterior
                    if($albumOld->portada !== 'default-cover.webp'){
                        unlink($directorio . '/' . $albumOld->portada);
                    }
                } else {
                    $album->portada = $albumOld->portada;
                }                    
                
                $album->guardar();

                $albumArtista->id_artistas = $_POST['artistas'];
                $albumArtista->guardar();

                if(!empty($_POST['art-secundarios'])){
                    //Asignar los artistas secundarios al album
                    $albumArtSecundarios->artistas = $_POST['art-secundarios'];
                    $albumArtSecundarios->guardar();
                }
                //debugging($_POST['selectedLanguages']);
                //debugging($albumIdiomas);
                //guardar los idiomas del album
                foreach ($albumIdiomas as $albumIdioma) {
                    $albumIdioma->eliminar();
                }

                $idIdiomas = explode(',', $_POST['selectedLanguages']);
                foreach($idIdiomas as $idIdioma){
                    if($buscarIdioma->id_idioma !== $idIdioma){
                        $albumIdioma = new AlbumIdiomas;
                        $albumIdioma->id_album = $album->id;
                        $albumIdioma->id_idioma = $idIdioma;
                        $albumIdioma->guardar();
                    }
                }

                header('Location: /music/albums');
            }
        }


        $router->render('music/albums/edit',[
            'titulo' => $titulo,
            'album' => $album,
            'lang' => $lang,
            'albumArtSecundarios' => $albumArtSecundarios,
            'sellos' => $sellos,
            'tipoUsuario' => $tipoUsuario,
            'artistas' => $artistas,
            'selectedArtistId' => $selectedArtistId,
            'selectedLanguages' => $selectedLanguages,
            'idiomas' => $idiomas
        ]);
    }

    public static function delete(Router $router){
        isMusico();
        redireccionar('/music/albums');
        $albumId = redireccionar('/music/albums');
        $album = Albums::find($albumId);
        $resultado = $album->eliminar();
        if($resultado){
            header('Location: /music/albums');
        }
    }

    public static function newSingle(Router $router){
        isMusico();
        $titulo = 'music_singles_new-title';
        $single = true;
        $id = $_SESSION['id'];
        $tipoUsuario = NTMusica::where('id_usuario', $id);
        $song = new Canciones;
        $lang = $_SESSION['lang'] ?? 'en';
        $songColab = new CancionColab;
        
        $selectedCategories = [];
        $consultaCategorias = "SELECT * FROM categorias WHERE id NOT IN (1, 2, 3);";
        $categorias = Categorias::consultarSQL($consultaCategorias);

        $niveles = NivelCancion::AllOrderAsc('nivel_en');
        $artistas = Artistas::whereOrdered('id_usuario', $_SESSION['id'], 'nombre');
        
        if($lang == 'en'){
            $generos = Genres::AllOrderAsc('genero_en');
        }else{
            $generos = Genres::AllOrderAsc('genero_es');
        }
        $selectedGenres = [];

        $consultaInstrumentos= "SELECT k.id AS id, k.keyword_en, k.keyword_es, c.id AS id_categoria FROM keywords AS k LEFT JOIN categ_keyword AS w ON k.id = w.id_keyword LEFT JOIN categorias AS c ON w.id_categoria = c.id WHERE c.id = 2;";
        $instrumentos = Keywords::consultarSQL($consultaInstrumentos);
        $selectedInstruments = [];

        $consultaKeywords = "SELECT k.* FROM keywords k INNER JOIN categ_keyword ck ON k.id = ck.id_keyword WHERE ck.id_categoria NOT IN (1, 2);";
        $keywords = Keywords::consultarSQL($consultaKeywords);
        $selectedKeywords = [];

        $idiomas = Idiomas::AllOrderAsc('idioma_en');
        $selectedLanguages = [];

        $router->render('music/albums/singles/new',[
            'titulo' => $titulo,
            'single' => $single,
            'tipoUsuario' => $tipoUsuario,
            'song' => $song,
            'lang' => $lang,
            'songColab' => $songColab,
            'categorias' => $categorias,
            'selectedCategories' => $selectedCategories,
            'niveles' => $niveles,
            'artistas' => $artistas,
            'lang' => $lang,
            'generos' => $generos,
            'selectedGenres' => $selectedGenres,
            'instrumentos' => $instrumentos,
            'selectedInstruments' => $selectedInstruments,
            'keywords' => $keywords,
            'selectedKeywords' => $selectedKeywords,
            'idiomas' => $idiomas,
            'selectedLanguages' => $selectedLanguages
        ]);
    }
}