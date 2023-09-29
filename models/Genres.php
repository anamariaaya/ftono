<?php

namespace Model;

class Genres extends ActiveRecord{
    protected static $tabla = 'generos';
    protected static $columnasDB = ['id', 'genero_en', 'genero_es'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->genero_en = $args['genero_en'] ?? '';
        $this->genero_es = $args['genero_es'] ?? '';
    }

    public function validar_tipo() {
        if(!$this->genero_en) {
            self::$alertas['error'][] = 'You must type a genre in English';
        }
        if(!$this->genero_es) {
            self::$alertas['error'][] = 'Debes escribir un género en Español';
        }
        return self::$alertas;
    }
}
