<?php

namespace Controllers;

use MVC\Router;
use Model\Genres;
use Model\Promos;
use Model\Artistas;
use Model\Featured;
use Model\Keywords;
use Model\Canciones;
use Classes\Contacto;
use Model\Categorias;
use Model\CancionData;
use Model\CancionNivel;
use Model\NivelCancion;
use Model\CancionGenero;
use Model\ContactoCompra;
use Model\CancionKeywords;
use Model\ArtistSongsPlayer;
use Model\CancionCategorias;
use Model\CancionInstrumento;
use Model\CancionGenSecundarios;

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

    public static function about(Router $router){
        $titulo = 't-about';
        $router->render('/paginas/about',[
            'titulo' => $titulo
        ]);
    }

    public static function contact(Router $router){
        $titulo = 't-contact';
        $lang = $_SESSION['lang'];
        $alertas = [];
        $contacto = new ContactoCompra;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $contacto->sincronizar($_POST);
            $recaptchaSecret = '6LdErd0pAAAAAPHTvAFVSJCWoyznzgaDUFqtvhb7';
            $recaptchaResponse = $_POST['g-recaptcha-response'];

            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaResponse}");
            $responseKeys = json_decode($response, true);
            if (intval($responseKeys["success"]) !== 1) {
                echo 'Please complete the CAPTCHA';
            } else {
                $alertas = $contacto->validar();
                if(empty($alertas)){
                    $email = new Contacto($contacto->nombre, $contacto->apellido, $contacto->email, $contacto->pais, $contacto->telefono, $contacto->mensaje);
                    $email->enviarMensaje();
                    $contacto = [];
                    ContactoCompra::setAlerta('exito','Mensaje enviado correctamente');
                }

            }
        }
        $alertas = ContactoCompra::getAlertas();
        $router->render('/paginas/contact',[
            'titulo' => $titulo,
            'lang' => $lang,
            'alertas' => $alertas,
            'contacto' => $contacto
        ]);
    }

    public static function faq(Router $router){
        $titulo = 't-faq';
        $router->render('/paginas/faq',[
            'titulo' => $titulo
        ]);
    }

    public static function terms(Router $router){
        $titulo = 't-terms-conditions';
        $router->render('/paginas/terms-conditions',[
            'titulo' => $titulo
        ]);
    }

    public static function privacy(Router $router){
        $titulo = 't-privacy';
        $router->render('/paginas/privacy',[
            'titulo' => $titulo
        ]);
    }

    public static function songLicensing(Router $router){
        $titulo = 't-song-licensing';
        $router->render('/paginas/song-licensing',[
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
        $consultaCanciones = 'SELECT c.titulo AS title,
            c.url AS videoId
            FROM canciones c
            INNER JOIN canc_artista ca ON ca.id_artista = '.$id.'
            WHERE c.id = ca.id_cancion AND c.url IS NOT NULL;';
            
        $songs = ArtistSongsPlayer::consultarSQL($consultaCanciones);
        $titulo = 'artist_title';
        $router->render('/paginas/artist',[
            'titulo' => $titulo,
            'artista' => $artista,
            'songs' => $songs
        ]);
    }

    public static function consultarArtista(){
        $id = redireccionar('/artists');
        $consultaCanciones = 'SELECT c.titulo AS title,
            c.url AS videoId
            FROM canciones c
            INNER JOIN canc_artista ca ON ca.id_artista = '.$id.'
            WHERE c.id = ca.id_cancion AND c.url IS NOT NULL;';
            
        $canciones = ArtistSongsPlayer::consultarSQL($consultaCanciones);
        echo json_encode($canciones);
    }

    public static function consultarFeaturedPlaylist(){
        $playlist = Featured::allOrderBy('id','DESC');
        echo json_encode($playlist);
    }

    public static function songsGenre(Router $router){
        $titulo = 'songs_genre_title';
        $lang = $_SESSION['lang'];
        $id = redireccionar('/genres');
        $genero = Genres::find($id);
        $router->render('/paginas/category-songs',[
            'titulo' => $titulo,
            'lang' => $lang,
            'genero' => $genero
        ]);
    }

    public static function consultarSongsGenre(){
        $id = redireccionar('/genres');
        $generos = CancionGenero::whereAll('id_genero',$id);
        $generosSec = CancionGenSecundarios::whereAll('id_genero',$id);
        $songs=[];
        //agregar al array de songs los generos y generos secundarios
        foreach($generos as $genero){
            $song = Canciones::find($genero->id_cancion);
            $songs[] = $song;
        }
        foreach($generosSec as $genero){
            $song = Canciones::find($genero->id_cancion);
            $songs[] = $song;
        }
        echo json_encode($songs);
    }

    public static function songsCategory(Router $router){
        $titulo = 'songs_category_title';
        $lang = $_SESSION['lang'];
        $id = redireccionar('/categories');
        $categoria = keywords::find($id);
        $name = $_GET['name'] ?? null;
        $cid = $_GET['cid'] ?? $id;
        //debugging($categoria);
        $router->render('/paginas/category-songs',[
            'titulo' => $titulo,
            'lang' => $lang,
            'categoria' => $categoria,
            'cid' => $cid,
            'name' => $name
        ]);
    }

    public static function consultarSongsCategory(){
        $id = redireccionar('/categories');
        $cid = $_GET['cid'] ?? $id;
        $category = Categorias::find($cid);
        $songs=[];
        if($category->categoria_en == 'instruments'){
            $keyword = CancionInstrumento::whereAll('id_instrumento',$id);
            foreach($keyword as $key){
                $song = Canciones::find($key->id_cancion);
                $songs[] = $song;
            }
        }elseif($category->categoria_en == 'keywords'){
            $keyword = CancionKeywords::whereAll('id_keywords',$id);
            foreach($keyword as $key){
                $song = Canciones::find($key->id_cancion);
                $songs[] = $song;
            }
        }else{
            $keyword = CancionKeywords::whereAll('id_keywords',$id);
            foreach($keyword as $key){
                $song = Canciones::find($key->id_cancion);
                $songs[] = $song;
            }
        }
        echo json_encode($songs);
    }

    public static function search(Router $router){
        $titulo = 't-search-songs';
        $lang = $_SESSION['lang'];
        $artistas = Artistas::all();
        $niveles = NivelCancion::all();

        $router->render('/paginas/search',[
            'titulo' => $titulo,
            'lang' => $lang,
            'artistas' => $artistas,
            'niveles' => $niveles
        ]);
    }

    public static function allSongs(){
        $consultaSongs = 'SELECT c.id,
                c.titulo,
                c.url,
                ar.nombre AS artista_name
            FROM canciones c
            LEFT JOIN 
                canc_artista ca ON c.id = ca.id_cancion
            LEFT JOIN
                artistas ar ON ca.id_artista = ar.id
            WHERE c.url IS NOT NULL;'
        ;
        $songs = CancionData::consultarSQL($consultaSongs);
        echo json_encode($songs);
    }

    public static function filterSongs() {
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $searchArtista = isset($_GET['artist']) ? $_GET['artist'] : '';
        $searchLevel = isset($_GET['level']) ? $_GET['level'] : '';
        //$searchLevel = 1;

        if($searchTerm !== '' || $searchArtista !== '' || $searchLevel !== ''){
            $searchTerm = s(filter_var($searchTerm, FILTER_SANITIZE_STRING));
            $consultaTerm = "SELECT DISTINCT c.id,
                c.titulo,
                c.url,
                ar.nombre AS artista_name,
                l.letra,
                k.keyword_en AS keywords_en,
                k.keyword_es AS keywords_es,
                n.nivel_en AS nivel_cancion_es,
                n.nivel_es AS nivel_cancion_en
            FROM canciones c
            LEFT JOIN 
                canc_artista ca ON c.id = ca.id_cancion
            LEFT JOIN
                artistas ar ON ca.id_artista = ar.id
            LEFT JOIN
                canc_letra l ON c.id = l.id_cancion
            LEFT JOIN
                canc_keywords ck ON c.id = ck.id_cancion
            LEFT JOIN
                keywords k ON ck.id_keywords = k.id
            LEFT JOIN
                canc_nivel cn ON c.id = cn.id_cancion
            LEFT JOIN
                nivel_canc n ON cn.id_nivel = n.id
            WHERE c.url IS NOT NULL";

            if($searchTerm !== ''){
                $consultaTerm .= " AND (c.titulo LIKE '%".$searchTerm."%' OR l.letra LIKE '%" . $searchTerm . "%' OR k.keyword_en LIKE '%" . $searchTerm . "%' OR k.keyword_es LIKE '%" . $searchTerm . "%')";
            }           
            
            // Apply the artist filter if specified
            if ($searchArtista != '') {
                $consultaTerm .= " AND ar.id = " . (int)$searchArtista;
            }

            if($searchLevel != ''){
                $consultaTerm .= " AND n.id = " . (int)$searchLevel;
            }

            $consultaTerm .= " GROUP BY c.id;";

            $songs = CancionData::consultarSQL($consultaTerm);
        }else{
            $songs = [];
        }
        echo json_encode($songs);  // Return matching songs as JSON
    }
}