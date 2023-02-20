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
        //session_start();
        define('DEFAULT_LANGUAGE', 'en');
        chooseLanguage();        

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

    public function render($view, $datos = []){
        foreach ($datos as $key => $value) {
            $$key = $value; 
        }
        $file = __DIR__.'/views/'.$view.'.php';
        $string = file_get_contents($file);
        $trans = array(
            '{{' => '<?php echo t("',
            '}}' => '"); ?>'
        );
        
        $string = strtr($string, $trans);

        file_put_contents($file, $string);

        ob_start();         

        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia el Buffer

        //Utilizar el layout de acuerdo a la URL
        $url_actual = $_SERVER['PATH_INFO'] ?? '/';
        //debugging($_SESSION);

        if(str_contains($url_actual, '/filmtono')) {
            include_once __DIR__ . "/views/layouts/admin-layout.php";
        } elseif(str_contains($url_actual, '/clients') || (isset($_SESSION['nivel_compra']) && str_contains($url_actual, '/complete-register'))) {
            include_once __DIR__ . "/views/layouts/compras-layout.php";
        } elseif(str_contains($url_actual, '/music') || (isset($_SESSION['nivel_musica'])&& str_contains($url_actual, '/complete-register'))) {
            include_once __DIR__ . "/views/layouts/musica-layout.php";
        } else {
            include_once __DIR__ . "/views/layouts/main-layout.php";
        }
    }
}
