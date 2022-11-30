<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();

        if(!isset($_SESSION['lang'])){
            $_SESSION['lang'] = 'en';
        } else if(isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])){
            if($_GET['lang'] == 'en'){
                $_SESSION['lang'] = 'en';
            } else if($_GET['lang'] == 'es'){
                $_SESSION['lang'] = 'es';
            }
        }        

        $url_actual = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$url_actual] ?? null;
        } else {
            $fn = $this->postRoutes[$url_actual] ?? null;
        }

        if ( $fn ) {
            call_user_func($fn, $this);
        } else {
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value; 
        }

        ob_start(); 

        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia el Buffer

        //Utilizar el layout de acuerdo a la URL
        $url_actual = $_SERVER['PATH_INFO'] ?? '/';

        if(str_contains($url_actual, '/filmtono')) {
            include_once __DIR__ . "/views/layouts/admin-layout.php";
        } elseif(str_contains($url_actual, '/compras')) {
            include_once __DIR__ . "/views/layouts/compras-layout.php";
        } elseif(str_contains($url_actual, '/musica')) {
            include_once __DIR__ . "/views/layouts/musica-layout.php";
        } else {
            include_once __DIR__ . "/views/layouts/main-layout.php";
        }
    }
}
