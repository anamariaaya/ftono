<?php

namespace Model;

class CTRArtistico extends ActiveRecord{
    protected static $tabla = 'ctr_artistico';
    protected static $columnasDB = ['id', 'nombre_doc', 'id_usuario'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->id_usuario = $args['id_usuario'] ?? '';
    }
}