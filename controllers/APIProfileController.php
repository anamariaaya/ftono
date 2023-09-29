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

    public static function alerts(){
        //leer el archivo de alerts.json
        $archivo = file_get_contents(__DIR__.'/../alerts.json');
        //convertir el json a un arreglo asociativo
        $archivo = json_decode($archivo, true);
        //debugging($archivo);
        echo json_encode($archivo);
    }

    public static function contracts(){
        //leer el archivo de contracts.json
        $archivo = file_get_contents(__DIR__.'/../contracts.json');
        //convertir el json a un arreglo asociativo
        $archivo = json_decode($archivo, true);
        //debugging($archivo);
        echo json_encode($archivo);
    }

    public static function ContratoMusical(){
        $archivo = file_get_contents(__DIR__.'/../views/contracts/c-musical-'.$_SESSION['lang'].'.php');
        
        echo json_encode($archivo);
    }

    public static function ContratoArtistico(){
        $archivo = file_get_contents(__DIR__.'/../views/contracts/c-artistico-'.$_SESSION['lang'].'.php');

        echo json_encode($archivo);
    }

    public static function profileStatus(){
        $respuesta = $_POST['perfil'];
        $usuario = Usuario::find($_SESSION['id']);
        $usuario->perfil = $respuesta;
        $resultado = $usuario->guardar();

        echo json_encode(['resultado' => $resultado]);
    }
}

