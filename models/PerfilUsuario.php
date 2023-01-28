<?php

namespace Model;

class PerfilUsuario extends ActiveRecord{
    protected static $tabla = 'n_t_admin';
    protected static $columnasDB = ['id', 'id_usuario', 'id_empresa'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? '';
        $this->id_empresa = $args['id_empresa'] ?? '';
    }
}
