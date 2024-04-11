<?php

namespace Controllers\Filmtono;

use MVC\Router;
use Model\Sellos;
use Model\Empresa;
use Model\Usuario;
use Model\NTMusica;
use Model\PerfilUsuario;
use Model\UsuarioSellos;

class LabelsController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'music_labels-title';
        $ntmusica = NTMusica::all();

        $userIds = [];
        $companyIds = [];
        $sellosIds = [];
        $usuarios = Usuario::innerJoin('usuarios','n_t_musica','id', 'id_usuario');

        $aggregators = NTMusica::whereAll('id_musica', 1);
        $publishers = NTMusica::whereAll('id_musica', 2);
        $labels = NTMusica::whereAll('id_musica', 3);
        //debugging($agregadores);

        foreach ($usuarios as $usuario) {

            $userIds[] = $usuario->id;
        }
        $userIdsString = implode(',', $userIds);

        $consultaUsuarioSellos = "SELECT usuario_sellos.*
        FROM usuario_sellos
        INNER JOIN usuarios
        ON usuario_sellos.id_usuario = usuarios.id  WHERE usuarios.id IN (".$userIdsString.");";

        $usuarioSellos = UsuarioSellos::consultarSQL($consultaUsuarioSellos);
        foreach ($usuarioSellos as $usuarioSello) {
            $companyIds[] = $usuarioSello->id_empresa;
            $sellosIds[] = $usuarioSello->id_sellos;
        }

        $companyIdsString = implode(',', $companyIds);
        $sellosIdsString = implode(',', $sellosIds);

        $consultaEmpresas = "SELECT empresa.*
        FROM empresa
        INNER JOIN usuario_sellos
        ON empresa.id = usuario_sellos.id_empresa WHERE usuario_sellos.id_empresa IN (".$companyIdsString.");";

        $empresas = Empresa::consultarSQL($consultaEmpresas);

        $consultaSellos = "SELECT sellos.*
        FROM sellos
        INNER JOIN usuario_sellos
        ON sellos.id = usuario_sellos.id_sellos WHERE usuario_sellos.id_sellos IN (".$sellosIdsString.");";

        $sellos = Sellos::consultarSQL($consultaSellos);

        $router->render('/admin/labels/index',[
            'titulo' => $titulo,
            'usuarios' => $usuarios,
            'usuarioSellos' => $usuarioSellos,
            'empresas' => $empresas,
            'sellos' => $sellos,
            'ntmusica' => $ntmusica,
            'aggregators' => $aggregators,
            'publishers' => $publishers,
            'labels' => $labels
        ]);
    }
}