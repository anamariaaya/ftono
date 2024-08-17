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
        $artistas = Artistas::AllOrderAsc('nombre');
        $router->render('music/artists/index',[
            'titulo' => $titulo,
            'artistas' => $artistas
        ]);
    }

    public static function consultaArtistas(){
        isMusico();
        $artistas = Artistas::AllOrderAsc('nombre');
        echo json_encode($artistas);
    }

    public static function new(Router $router){
        isMusico();
        $titulo = 'artists_new-title';
        $alertas = [];
        $artista = new Artistas();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $artista->sincronizar($_POST);
            $artista->nombre = sText($artista->nombre);
            $artista->precio_show = filter_var($artista->precio_show, FILTER_SANITIZE_NUMBER_INT);

            $alertas = $artista->validarArtista();
            if(empty($alertas)){
                $existeArtista = Artistas::where('nombre', $artista->nombre);
                if($existeArtista){
                    Artistas::setAlerta('error', 'artists_alert_already-exist');
                    $alertas = Artistas::getAlertas();
                }else{
                    $resultado = $artista->guardar();
                    if($resultado){
                        header('Location: /music/artists');
                    }
                }
            }
        }
        $router->render('music/artists/new',[
            'titulo' => $titulo,
            'alertas' => $alertas,
            'artista' => $artista
        ]);
    }

    public static function edit(Router $router){
        isMusico();
        $titulo = 'artists_edit-title';
        $id = redireccionar('/music/artists');
        $artista = Artistas::find($id);
        $alertas = Artistas::getAlertas();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $artista->sincronizar($_POST);
            $artista->nombre = sText($artista->nombre);
            $artista->precio_show = filter_var($artista->precio_show, FILTER_SANITIZE_NUMBER_INT);
            $alertas = $artista->validarArtista();
            if(empty($alertas)){
                $resultado = $artista->guardar();
                if($resultado){
                    header('Location: /music/artists');
                }
            }
        }
        $router->render('music/artists/edit',[
            'titulo' => $titulo,
            'alertas' => $alertas,
            'artista' => $artista
        ]);
    }

    public static function delete(){
        isMusico();
        $id = s($_GET['id']);
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $artista = Artistas::find($id);
        $resultado = $artista->eliminar();
        if($resultado){
            header('Location: /music/artists');
        }
    }
}