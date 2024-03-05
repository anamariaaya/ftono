<?php

namespace Controllers\Filmtono;

use MVC\Router;
use Model\Empresa;
use Model\Usuario;
use Model\CTRMusical;
use Model\CTRArtistico;
use Model\PerfilUsuario;
use Model\ContratosUsuario;

class ContractsController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'contracts_main-title';
        $contratosMusical = CTRMusical::All();
        $contratosArtistico = CTRArtistico::All();
        $consulta = 'SELECT ctr.id, ctr.fecha, ctr.nombre_doc, u.nombre AS nombre, u.apellido AS apellido, ';
        $consulta .= 'e.empresa AS empresa ';
        $consulta .= 'FROM (SELECT * FROM ctr_musical UNION ALL SELECT * FROM ctr_artistico) AS ctr ';
        $consulta .= 'JOIN perfil_usuario pu ON pu.id_usuario = ctr.id_usuario ';
        $consulta .= 'JOIN usuarios u ON u.id = pu.id_usuario ';
        $consulta .= 'JOIN empresa e ON e.id = pu.id_empresa;';
        $contratos = ContratosUsuario::consultarSQL($consulta);

        $router->render('/admin/contracts/index',[
            'titulo' => $titulo,
            'contratosMusical' => $contratosMusical,
            'contratosArtistico' => $contratosArtistico,
            'contratos' => $contratos
        ]);
    }
}