<?php

namespace Model;

class CTRMusical extends ActiveRecord{
    protected static $tabla = 'ctr_musical';
    protected static $columnasDB = ['id', 'nombre_doc', 'id_usuario'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre_doc = $args['nombre_doc'] ?? '';
        $this->id_usuario = $args['id_usuario'] ?? '';
    }
}