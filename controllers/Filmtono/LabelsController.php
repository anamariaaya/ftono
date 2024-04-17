<?php

namespace Controllers\Filmtono;

use MVC\Router;
use Model\Sellos;
use Model\Empresa;
use Model\Usuario;
use Model\NTMusica;
use Model\UserLabels;
use Model\PerfilUsuario;
use Model\UsuarioSellos;

class LabelsController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 't-labels';
        $ntmusica = NTMusica::all();

        $aggregators = NTMusica::whereAll('id_musica', 1);
        $aggregators = count($aggregators);
        $publishers = NTMusica::whereAll('id_musica', 2);
        $publishers = count($publishers);
        $labels = NTMusica::whereAll('id_musica', 3);
        $labels = count($labels);
        $labelsTotal = Sellos::all();
        $labelsTotal = count($labelsTotal);

        $router->render('/admin/labels/index',[
            'titulo' => $titulo,
            'aggregators' => $aggregators,
            'publishers' => $publishers,
            'labels' => $labels,
            'labelsTotal' => $labelsTotal
        ]);
    }

    public static function consultaUsuariosMusica(){
        isAdmin();
        $titulo = 'music_labels-title';
        $ntmusica = NTMusica::all();

        // $userIds = [];
        // $companyIds = [];
        // $sellosIds = [];
        // $usuarios = Usuario::innerJoin('usuarios','n_t_musica','id', 'id_usuario');

        // foreach ($usuarios as $usuario) {

        //     $userIds[] = $usuario->id;
        // }
        // $userIdsString = implode(',', $userIds);

        // $consultaUsuarioSellos = "SELECT usuario_sellos.*
        // FROM usuario_sellos
        // INNER JOIN usuarios
        // ON usuario_sellos.id_usuario = usuarios.id  WHERE usuarios.id IN (".$userIdsString.");";

        // $usuarioSellos = UsuarioSellos::consultarSQL($consultaUsuarioSellos);
        // foreach ($usuarioSellos as $usuarioSello) {
        //     $companyIds[] = $usuarioSello->id_empresa;
        //     $sellosIds[] = $usuarioSello->id_sellos;
        // }

        // $companyIdsString = implode(',', $companyIds);
        // $sellosIdsString = implode(',', $sellosIds);

        // $consultaEmpresas = "SELECT empresa.*
        // FROM empresa
        // INNER JOIN usuario_sellos
        // ON empresa.id = usuario_sellos.id_empresa WHERE usuario_sellos.id_empresa IN (".$companyIdsString.");";

        // $empresas = Empresa::consultarSQL($consultaEmpresas);

        // $consultaSellos = "SELECT sellos.*
        // FROM sellos
        // INNER JOIN usuario_sellos
        // ON sellos.id = usuario_sellos.id_sellos WHERE usuario_sellos.id_sellos IN (".$sellosIdsString.");";

        $consultaSellos ="SELECT s.nombre AS labelName, s.creado AS labelDate, s.id AS labelId,
        u.id AS userId, CONCAT(u.nombre, ' ', u.apellido) AS userName,
        e.id AS companyId, e.empresa AS companyName,
        m.id_musica AS musicType
            FROM sellos s
            INNER JOIN usuario_sellos
            INNER JOIN usuarios u
            INNER JOIN empresa e
            INNER JOIN n_t_musica m
            WHERE u.id = usuario_sellos.id_usuario AND s.id = usuario_sellos.id_sellos AND e.id= usuario_sellos.id_empresa AND m.id_usuario = usuario_sellos.id_usuario;";

        $userLabels = UserLabels::consultarSQL($consultaSellos);
        echo json_encode($userLabels);
    }
}