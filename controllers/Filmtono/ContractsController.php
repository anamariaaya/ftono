<?php

namespace Controllers\Filmtono;

use MVC\Router;
use Model\Empresa;
use Model\CTRMusical;
use Model\CTRArtistico;
use Model\PerfilUsuario;

class ContractsController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'contracts_main-title';
        $contratosMusical = CTRMusical::all();
        $contratosArtistico = CTRArtistico::all();
        $contratos = CTRMusical::unionTables('ctr_musical', 'ctr_artistico');
        $empresas = Empresa::all();
        $perfilUsuario = PerfilUsuario::all();

        $router->render('/admin/contracts/index',[
            'titulo' => $titulo,
            'contratosMusical' => $contratosMusical,
            'contratosArtistico' => $contratosArtistico,
            'perfilUsuario' => $perfilUsuario,
            'empresas' => $empresas,
            'contratos' => $contratos
        ]);
    }
}