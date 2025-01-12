<?php

namespace Model;

class CancionInstrumento extends ActiveRecord{
    protected static $tabla = 'canc_instrumento';
    protected static $columnasDB = ['id', 'id_instrumento', 'id_cancion'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_instrumento = $args['id_instrumento'] ?? '';
        $this->id_cancion = $args['id_cancion'] ?? '';
    }
}