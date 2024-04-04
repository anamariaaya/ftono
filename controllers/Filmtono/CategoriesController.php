<?php

namespace Controllers\Filmtono;

use MVC\Router;
use Model\Categorias;

class CategoriesController{
    public static function index(Router $router){
        isAdmin();
        $titulo = 'categories_main-title';
        $categorias = Categorias::All();
        $router->render('/admin/categories/index',[
            'titulo' => $titulo,
            'categorias' => $categorias
        ]);
    }

    public static function consultarCategorias(){
        $categorias = Categorias::allOrderAsc('id');
        echo json_encode($categorias);
    }

    public static function new(Router $router){
        isAdmin();
        $titulo = 'categories_new-title';
        $categoria = new Categorias();
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $args = $_POST;
            $categoria->sincronizar($args);
            $alertas = $categoria->validar();
            if(empty($alertas)){
                $resultado = $categoria->guardar();
                if($resultado){
                    header('Location: /filmtono/categories');
                }else{
                    Categorias::setAlerta('error','alert-error');
                }
            }
        }

        $alertas = Categorias::getAlertas();
        $router->render('/admin/categories/new',[
            'titulo' => $titulo,
            'categoria' => $categoria,
            'alertas' => $alertas
        ]);
    }

    public static function edit(Router $router){
        isAdmin();
        $titulo = 'categories_edit-title';
        $id = redireccionar('/admin/categories');
        $categoria = Categorias::find($id);
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $args = $_POST;
            $categoria->sincronizar($args);
            $alertas = $categoria->validar();
            if(empty($alertas)){
                $resultado = $categoria->guardar();
                if($resultado){
                    header('Location: /filmtono/categories');
                }else{
                    Categorias::setAlerta('error','alert-error');
                }
            }
        }
        $alertas = Categorias::getAlertas();
        $router->render('/admin/categories/edit',[
            'titulo' => $titulo,
            'categoria' => $categoria,
            'alertas' => $alertas
        ]);
    }

    public static function delete(){
        isAdmin();
        $id = $_GET['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);
        if($id){
            $categoria = Categorias::find($id);
            $resultado = $categoria->eliminar();
            if($resultado){
                header('Location: /filmtono/categories');
            }
        }
    }
}