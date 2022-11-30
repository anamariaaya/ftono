<?php

define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'].'/images/');
define('CARPETA_DOCS', $_SERVER['DOCUMENT_ROOT'].'/docs/');

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

function sesionActiva() : void {
    if(isset($_SESSION['nivel_admin'])){
        echo '/filmtono/dashboard';
    } elseif(isset($_SESSION['nivel_compra'])){
        echo '/compras/dashboard';
    } elseif(isset($_SESSION['nivel_musica'])){
        echo '/musica/dashboard';
    } else{
        echo '/';
    }
}