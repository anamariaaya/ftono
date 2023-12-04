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
        $titulo = 'Contracts';
        $contratosMusical = CTRMusical::all();
        $contratosArtistico = CTRArtistico::all();

//create an array of objects with all the data from the database when finding the user id

        foreach($contratosMusical as $contratoMusical){
            $perfilUsuario = PerfilUsuario::where('id_usuario', $contratoMusical->id_usuario);
            $empresa = Empresa::find($perfilUsuario->id_empresa);
            $empresas[] = $empresa;
        }

        $router->render('/admin/contracts/index',[
            'titulo' => $titulo,
            'contratosMusical' => $contratosMusical,
            'contratosArtistico' => $contratosArtistico,
            'perfilUsuario' => $perfilUsuario,
            'empresas' => $empresas
        ]);
    }
}