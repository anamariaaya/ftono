<?php
namespace Controllers\Music;

use MVC\Router;
use Model\Empresa;
use Model\CTRMusical;
use Model\CTRArtistico;
use Model\PerfilUsuario;


class CompanyController{
    public static function index(Router $router){
        isMusico();
        $titulo = 'company_title';
        $alertas = [];
        $perfilUsuario = PerfilUsuario::where('id_usuario', $_SESSION['id']);
        $empresa = Empresa::find($perfilUsuario->id_empresa);

        $router->render('music/company/index',[
            'titulo' => $titulo,
            'alertas' => $alertas,
            'empresa' => $empresa
        ]);
    }

    public static function contracts(Router $router){
        isMusico();
        $titulo = 'contracts_main-title';
        $alertas = [];
        $contratoArtistico = CTRArtistico::where('id_usuario', $_SESSION['id']);
        $contratoMusical = CTRMusical::where('id_usuario', $_SESSION['id']);

        $router->render('music/company/contracts',[
            'titulo' => $titulo,
            'alertas' => $alertas,
            'contratoArtistico' => $contratoArtistico,
            'contratoMusical' => $contratoMusical
        ]);
    }
}