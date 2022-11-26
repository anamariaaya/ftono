<?php

namespace Model;

class TipoMusica extends ActiveRecord{
    protected static $tabla = 'tipo_musica';
    protected static $columnasDB = ['id', 'tipo'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->tipo = $args['tipo'] ?? '';
    }
}
