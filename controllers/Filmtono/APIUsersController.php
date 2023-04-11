<?php

namespace Controllers\Filmtono;

use Model\UsuarioTipo;

class APIUsersController{
    public static function index(){
        isAdmin();

        // $consulta = "SELECT usuarios.id, usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.confirmado, n_t_admin.id_nivel AS nivel_admin, n_t_musica.id_nivel AS nivel_musica, n_t_compra.id_nivel AS compradores, empresa.empresa FROM usuarios LEFT OUTER JOIN n_t_admin ON usuarios.id = n_t_admin.id_usuario LEFT OUTER JOIN n_t_musica ON usuarios.id = n_t_musica.id_usuario LEFT OUTER JOIN n_t_compra ON usuarios.id = n_t_compra.id_usuario LEFT OUTER JOIN empresa ON usuarios.id = empresa.id_usuario";
        $consulta = Usuarios::all();

        $usuarios = UsuarioTipo::consultarSQL($consulta);
        
        echo json_encode($usuarios);
    }
}