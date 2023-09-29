<?php

namespace Model;

class Canciones extends ActiveRecord{
    protected static $tabla = 'canciones';
    protected static $columnasDB = ['id', 'titulo', 'version', 'letra', 'isrc', 'url'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->version = $args['version'] ?? '';
        $this->letra = $args['letra'] ?? '';
        $this->isrc = $args['isrc'] ?? '';
        $this->url = $args['url'] ?? '';
    }

    public function validar_tipo() {
        if(!$this->titulo) {
            self::$alertas['error'][] = 'El Título de la Canción es Obligatorio';
        }
        if(!$this->version) {
            self::$alertas['error'][] = 'La Versión de la Canción es Obligatoria';
        }
        if(!$this->isrc) {
            self::$alertas['error'][] = 'El ISRC de la Canción es Obligatorio';
        }
        if(!$this->url) {
            self::$alertas['error'][] = 'La URL de la Canción es Obligatoria';
        }
        return self::$alertas;
    }
}
