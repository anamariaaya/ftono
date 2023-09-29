<?php

namespace Model;

class CancGenero extends ActiveRecord{
    protected static $tabla = 'canc_genero';
    protected static $columnasDB = ['id', 'id_cancion', 'id_genero'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_cancion = $args['id_cancion'] ?? '';
        $this->id_genero = $args['id_genero'] ?? '';
    }
}
