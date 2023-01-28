<?php

namespace Controllers;

use Model\Sellos;
use Model\Empresa;
use Model\Usuario;
use Model\NTMusica;


class APIProfileController{

    public static function lenguaje(){
        echo json_encode($_SESSION['lang']);
    }

    public static function profile(){        
        $registro = new Empresa($_POST);
        $usuario = Usuario::find($_SESSION['id']);
        $registro->id_usuario = $usuario->id;
        //Agregar los id al perfil_usuario (IMPORTANTE)
        
        $resultado = $registro->guardar();
    
        echo json_encode(['resultado' => $resultado]);
    }

    public static function profileSellos(){
        $nivel = NTMusica::where('id_usuario', $_SESSION['id']);
        if(isset($nivel)){
            if($nivel->id_musica === '3'){
                $resultado = new Sellos($_POST);
                $resultado->guardar();
            }
        }
        echo json_encode(['resultado' => $resultado]);
    }

    public static function profileStatus(){
        $respuesta = $_POST['perfil'];
        $usuario = Usuario::find($_SESSION['id']);
        $usuario->perfil = $respuesta;
        $resultado = $usuario->guardar();

        echo json_encode(['resultado' => $resultado]);
    }
}

