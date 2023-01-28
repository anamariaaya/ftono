<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\NTAdmin;
use Model\Usuario;
use Model\NTCompra;
use Model\NTMusica;
use Model\TipoMusica;
use Model\TipoComprador;

class AuthController {
    public static function login(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $usuario = new Usuario($_POST);
            
            $alertas = $usuario->validarLogin();
            
            if(empty($alertas)) {
                // Verificar quel el usuario exista
                $usuario = Usuario::where('email', $usuario->email);

                if(!$usuario || !$usuario->confirmado ) {
                    Usuario::setAlerta('error', 'El Usuario No Existe o no esta confirmado');
                } else {
                    // El Usuario existe
                    if( password_verify($_POST['password'], $usuario->password) ) {
                        $nivel_compra = NTCompra::where('id_usuario', $usuario->id);
                        $nivel_musica = NTMusica::where('id_usuario', $usuario->id);
                        $nivel_admin = NTAdmin::where('id_usuario', $usuario->id);
                        
                        // Iniciar la sesión
                        session_start();    
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido'] = $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['perfil'] = $usuario->perfil;

                        // Verificar el nivel de acceso y redireccionar
                        if($nivel_compra) {
                            $_SESSION['nivel_compra'] = $nivel_compra->id_nivel;
                            header('Location: /clients/dashboard');
                        }elseif($nivel_musica) {
                            $_SESSION['nivel_musica'] = $nivel_musica->id_nivel;
                            header('Location: /music/dashboard');
                        }elseif($nivel_admin) {
                            $_SESSION['nivel_admin'] = $nivel_admin->id_nivel;
                            header('Location: /filmtono/dashboard');
                        } else {
                            header('Location: /');
                        }
                        
                    } else {
                        Usuario::setAlerta('error', 'Password Incorrecto');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        // Render a la vista 
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION = [];
            session_destroy();
            header('Location: /');
        }       
    }

    public static function register(Router $router) {
        $alertas = [];
        $comprador = TipoComprador::allOrderBy('tipo');
        $usuario = new Usuario;
        $tipoComprador = new NTCompra;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $tipoComprador->sincronizar($_POST);
            
            $alertas = $usuario->validar_cuenta();
            $alertas = $tipoComprador->validar_tipo();

            if(empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El Usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Eliminar password2
                    unset($usuario->password2);

                    // Generar el Token
                    $usuario->crearToken();

                    // Crear un nuevo usuario
                    $resultado =  $usuario->guardar();
                    
                    $tipoComprador->id_usuario = $resultado['id'];
                    $tipoComprador->guardar();

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    

                    if($resultado) {
                        header('Location: /message');
                    }
                }
            }
        }

        // Render a la vista
        $router->render('auth/register', [
            'titulo' => 'Crea tu cuenta y encuentra la mejor música para tus proyectos',
            'comprador' => $comprador,
            'usuario' => $usuario, 
            'alertas' => $alertas
        ]);
    }

    public static function registerMusic(Router $router){
        $alertas = [];
        $musico = TipoMusica::allOrderBy('tipo');
        $tipoMusico = new NTMusica;
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $tipoMusico->sincronizar($_POST);
            //debuguear($_POST);
            
            $alertas = $usuario->validar_cuenta();
            $alertas = $tipoMusico->validar_tipo();
            //debuguear($tipoMusico);

            if($tipoMusico->id_musica === '1' || $tipoMusico->id_musica === '2'){
                $tipoMusico->id_nivel = '2';
            } elseif($tipoMusico->id_musica === '3'){
                $tipoMusico->id_nivel = '3';
            }
            
            if(empty($alertas)){
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El Usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Eliminar password2
                    unset($usuario->password2);

                    // Generar el Token
                    $usuario->crearToken();

                    // Crear un nuevo usuario
                    $resultado =  $usuario->guardar();
                    
                    $tipoMusico->id_usuario = $resultado['id'];
                    $tipoMusico->guardar();

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    

                    if($resultado) {
                        header('Location: /message');
                    }
                }
            }

        }
        $router->render('auth/register-music', [
            'titulo' => 'Crea tu cuenta y sube tu catálogo músical',
            'alertas' => $alertas,
            'musico' => $musico
        ]);
    }

    public static function forgot(Router $router) {
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)) {
                // Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado) {

                    // Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    // Actualizar el usuario
                    $usuario->guardar();

                    // Enviar el email
                    $email = new Email( $usuario->email, $usuario->nombre, $usuario->token );
                    $email->enviarInstrucciones();


                    // Imprimir la alerta
                    // Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');

                    $alertas['exito'][] = 'Hemos enviado las instrucciones a tu email';
                } else {
                 
                    // Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');

                    $alertas['error'][] = 'El Usuario no existe o no esta confirmado';
                }
            }
        }

        // Muestra la vista
        $router->render('auth/forgot', [
            'titulo' => 'Olvidé mi Password',
            'alertas' => $alertas
        ]);
    }

    public static function reset(Router $router) {

        $token = s($_GET['token']);

        $token_valido = true;

        if(!$token) header('Location: /');

        // Identificar el usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Válido, intenta de nuevo');
            $token_valido = false;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Añadir el nuevo password
            $usuario->sincronizar($_POST);

            // Validar el password
            $alertas = $usuario->validarPassword();

            if(empty($alertas)) {
                // Hashear el nuevo password
                $usuario->hashPassword();

                // Eliminar el Token
                $usuario->token = null;

                // Guardar el usuario en la BD
                $resultado = $usuario->guardar();

                // Redireccionar
                if($resultado) {
                    header('Location: /login');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        // Muestra la vista
        $router->render('auth/reset', [
            'titulo' => 'Restablecer Password',
            'alertas' => $alertas,
            'token_valido' => $token_valido
        ]);
    }

    public static function message(Router $router) {

        $router->render('auth/message', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirm(Router $router) {
        
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        // Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            // No se encontró un usuario con ese token
            Usuario::setAlerta('error', 'Token No Válido. La cuenta no se confirmó');
        } else {
            // Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = '';
            unset($usuario->password2);
            
            // Guardar en la BD
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta Comprobada exitosamente');
        }

     

        $router->render('auth/confirm', [
            'titulo' => 'Confirma tu cuenta',
            'alertas' => Usuario::getAlertas()
        ]);
    }

    public static function CompleteRegister(Router $router){
        $usuario = Usuario::find($_SESSION['id']);
        $titulo = 'Completar registro';

        // $mpdf = new \Mpdf\Mpdf();
        // $mpdf->WriteHTML('Hola Andy');
        // $mpdf->OutputFile(__DIR__ . '/file.pdf');
        

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
           //debugging($_POST);
        }
        $router->render('auth/complete-register', [
            'titulo' => $titulo,
            'usuario' => $usuario
        ]);
    }
}