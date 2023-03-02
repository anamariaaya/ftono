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
        if($_SESSION['lang'] == 'en'){
            $archivo = file_get_contents(__DIR__.'/../views/contracts/c-musical-en.php');
        }else{
            $archivo = file_get_contents(__DIR__.'/../views/contracts/c-musical.php');
        }
        echo json_encode($archivo);
    }

    public static function ContratoArtistico(){
        $archivo = file_get_contents(__DIR__.'/../views/contracts/c-artistico.php');

        echo json_encode($archivo);
    }

    public static function firma(){
        //Leer el primer valor del array
        $img = array_shift($_POST);

        //get the image data from POST
        $data = base64_decode($img);
        
        //debugging($data);

        //save the image in a temporary folder
        //$resultado = file_put_contents('prueba'.'.png', $data);

        //save the file in the server
        // $resultado = file_put_contents(__DIR__.'/../views/contracts/firmas/'.$_SESSION['id'].'.png', $data);


        
        echo json_encode(['resultado' => $resultado]);
        //debugging($data);
        
        //generate the filename
        // $filename = 'my-cool-image.' . $type;
        
        // //save the image data to the server
        // file_put_contents($filename, $data);
        
        // //return the filename
        // echo $filename;

        // debugging($_POST);
        // $data = base64_decode($_POST['img']);

        // $resultado = $data;
        // // $resultado = file_put_contents(__DIR__.'/../views/contracts/firmas/'.$_SESSION['id'].'.png', $data);
        // echo json_encode(['resultado' => $resultado]);

        // debugging($data);
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

