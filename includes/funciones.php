<?php

define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'].'/images/');
define('CARPETA_DOCS', $_SERVER['DOCUMENT_ROOT'].'/docs/');

//Función para imprimir el código a probar y detener la ejecución del código siguiente
function debugging($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function redireccionar(string $url){
    $id = s($_GET['id']);
    //Validar la URL por ID válido
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location:${url}");
    }

    return $id;
}

//Revisa la página actual para resaltar el ícono del menú
function pagina_actual($path){
    if(str_contains($_SERVER['REQUEST_URI'], $path) === true){
        echo 'active';
    } else{
        return;
    }
}

function pagina_admin($path){
    if(str_contains($_SERVER['REQUEST_URI'], $path) === true){
        echo 'dashboard__enlace--actual';
    } else{
        return;
    }
}

// Función que revisa si el usuario está autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

//Funciones para revisar el nivel de usuario
function isAdmin() : void {
    if(!isset($_SESSION['nivel_admin'])){
        header('Location: /');
    }
}

function isComprador() : void {
    if(!isset($_SESSION['nivel_compra'])){
        header('Location: /');
    }
}

function isMusico() : void {
    if(!isset($_SESSION['nivel_musica'])){
        header('Location: /');
    }
}

//Compueba si el usuario está logueado y redirige a su dashboard
function sesionActiva() : void {
    if(isset($_SESSION['nivel_admin'])){
        echo '/filmtono/dashboard';
    } elseif(isset($_SESSION['nivel_compra'])){
        echo '/clients/dashboard';
    } elseif(isset($_SESSION['nivel_musica'])){
        echo '/music/dashboard';
    } else{
        echo '/';
    }
}

//bloquea ciertos botondes del dashboard si el usuario no está registrado por completo
function regBtn(){
    if($_SESSION['perfil'] === '0'){
        echo 'dashboard__enlace--disabled';
    }
}

//Comprueba si el usuario está registrado completando su perfil y verifica si es comprador para no restringir la navegación.
function isRegistered($mensaje, $contenido){
    $url = $_SERVER['REQUEST_URI'];
    if($_SESSION['perfil'] === '0' && !(strpos($url, '/complete-register') !== false && strpos($url, '/complete-register?'.$_SESSION['lang']) === false)):?>
        <p class="auth__text--post">
            <?php echo tt($mensaje); ?>
            <a href="/complete-register" class="btn-submit--post only--desktop" href="">
                <?php echo tt('complete_register')?>
            </a>
            <span class="auth__text--post--mobile only--mobile">
                <?php echo tt('complete_register_mobile')?>
            </span>
        </p>

        <?php if(strpos($url, '/music/profile') !== false): ?>
            <?php echo $contenido; ?>
        <?php endif; ?>

        <?php if(isset($_SESSION['nivel_compra'])){
            echo $contenido;
        } ?>

    <?php else:
        echo $contenido;        
    endif;
}

function chooseLanguage() {
    if(isset($_GET['lang'])) {
        $_SESSION['lang'] = s($_GET['lang']);
        setcookie("lang_cookie", s($_GET['lang']), time() + 31536000, "/");
    }else if(isset($_COOKIE['lang_cookie'])) {
        $_SESSION['lang'] = $_COOKIE['lang_cookie'];
    }else {
        $_SESSION['lang'] = DEFAULT_LANGUAGE;
    }
    
    return $_SESSION['lang'];
}

//Función para leer e imprimir cada valor del array de idiomas
function tt($key) {
    ob_start();
    $language = chooseLanguage();
    $translations = json_decode(file_get_contents('../lang.json'), true);
    $keys = array_keys($translations);

    if(!in_array($key, $keys)){
        return 'CORREGIR LLAVE en: ' . $key;
    } else{
        $strings = $translations[$key][$language];   

        return $strings;
    }
    ob_clean();
}