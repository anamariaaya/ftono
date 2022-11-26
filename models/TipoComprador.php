<?php

namespace Model;

class TipoComprador extends ActiveRecord{
    protected static $tabla = 'tipo_compra';
    protected static $columnasDB = ['id', 'tipo'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->tipo = $args['tipo'] ?? '';
    }
}
