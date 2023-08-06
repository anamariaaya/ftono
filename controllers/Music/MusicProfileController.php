<?php

namespace Controllers\Music;

use MVC\Router;
use Model\Usuario;

class MusicProfileController{
    public static function index(Router $router){
        isMusico();
        $alertas = Usuario::getAlertas();
        $usuario = Usuario::find($_SESSION['id']);

        $titulo = 'music_profile-title';        

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $args = $_POST;

            if($args['password'] === ''){
                $args['password'] = $usuario->password;
                $args['password2'] = $usuario->password;
            }

            $usuario->sincronizar($args);
            $alertas = $usuario->validarPassword();
            
            if(empty($alertas)){
                unset($usuario->password2);
                $usuario->hashPassword();
                $usuario->guardar();
                $alertas = Usuario::setAlerta('exito','profile_alert-profile-updated');          
            }            
        } 
        $alertas = Usuario::getAlertas();

        $router->render('music/profile/index',[
            'titulo' => $titulo,
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
}