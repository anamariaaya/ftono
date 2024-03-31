<?php

namespace Controllers\Filmtono;

use MVC\Router;
use Model\Terms;
use Classes\Email;
use Model\Empresa;
use Model\NTAdmin;
use Model\Privacy;
use Model\Usuario;
use Model\NTMusica;
use Model\CTRMusical;
use Model\TipoMusica;
use Model\Comunicados;
use Model\CTRArtistico;
use Model\PerfilUsuario;

class UsersController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'users_main_title';
        $usuarios = Usuario::All();
        $router->render('/admin/users/index',[
            'titulo' => $titulo,
            'usuarios' => $usuarios
        ]);
    }

    public static function current(Router $router){
        isAdmin();
        $titulo = 'users_main-title';
        $id = s($_GET['id']);
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $empresa = null;
        $ntadmin = null;
        $ntmusica = null;
        $tipoMusica = null;
        $usuario = Usuario::find($id);
        $perfilUsuario = PerfilUsuario::where('id_usuario', $id);
        if($perfilUsuario !== null){
            $empresa = Empresa::find($perfilUsuario->id_empresa);
        }
        $ntadmin = NTAdmin::where('id_usuario', $id);
        $ntmusica = NTMusica::where('id_usuario', $id);
        if($ntmusica !== null){
            $tipoMusica = TipoMusica::find($ntmusica->id_musica);
        }

        $router->render('/admin/users/current',[
            'titulo' => $titulo,
            'usuario' => $usuario,
            'empresa' => $empresa,
            'ntadmin' => $ntadmin,
            'ntmusica' => $ntmusica,
            'tipoMusica' => $tipoMusica
        ]);
    }

    public static function new(Router $router){
        isAdmin();
        $alertas = [];
        $titulo = 'users_new_title';
        $usuario = new Usuario();
        $tipoAdmin = new NTAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar_cuenta();
            $alertas = $usuario->validarPassword();

            if(empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);
                if($existeUsuario) {
                    Usuario::setAlerta('error', 'auth_alert_user-already-exist');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();
                    // Eliminar password2
                    unset($usuario->password2);

                    // Generar el Token
                    $usuario->crearToken();
                    $resultado =  $usuario->guardar();
                    $tipoAdmin->id_usuario = $resultado['id'];
                    $tipoAdmin->id_nivel = 1;
                    $tipoAdmin->guardar();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    if($lang == 'en'){
                        $email->enviarConfirmacion();
                    } else{
                        $email->enviarConfirmacionEs();
                    }
                    
                    if($resultado) {
                        header('Location: /filmtono/users');
                    }
                }
            }

            $usuario->password = password_hash($usuario->password, PASSWORD_DEFAULT);
            $usuario->perfil = 1;
            
        }
        $alertas = Usuario::getAlertas();

        $router->render('/admin/users/new',[
            'titulo' => $titulo,
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function delete(){
        isAdmin();
        $id = s($_GET['id']);
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $usuario = Usuario::find($id);
        $ntadmin = NTAdmin::where('id_usuario', $id);
        $ntmusica = NTMusica::where('id_usuario', $id);
        if($ntadmin){
            $resultado = $ntadmin->eliminar();
            $resultado = $usuario->eliminar();
            if($resultado) {
                header('Location: /filmtono/users');
            }
        }else{
            $perfilUsuario = PerfilUsuario::where('id_usuario', $id);
            if($perfilUsuario){
                $empresa = Empresa::find($perfilUsuario->id_empresa);
                $ctr_music = CTRMusical::where('id_empresa', $empresa->id);
                $ctr_artistico = CTRArtistico::where('id_empresa', $empresa->id);
                $terms = Terms::where('id_usuario', $usuario->id);
                $privacy = Privacy::where('id_usuario', $usuario->id);
                $comunicados = Comunicados::where('id_usuario', $usuario->id);
                if($ctr_music){
                    $file = $ctr_music->nombre_doc;
                    $file_route = '../public/contracts/'.$file;
                    //delete the file
                    unlink($file_route);
                    $ctr_music->eliminar();
                }
                if($ctr_artistico){
                    $file2 = $ctr_artistico->nombre_doc;
                    $file_route2 = '../public/contracts/'.$file2;
                    //delete the file
                    unlink($file_route2);
                    $ctr_artistico->eliminar();
                }
                $terms->eliminar();
                $privacy->eliminar();
                if($comunicados){
                    $comunicados->eliminar();
                }
                $perfilUsuario->eliminar();
                $empresa->eliminar();
            }
            $ntmusica->eliminar();
            $usuario->eliminar();
            header('Location: /filmtono/users');
        }
    }
}