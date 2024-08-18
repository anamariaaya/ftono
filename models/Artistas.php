<?php

namespace Model;

class Artistas extends ActiveRecord{
    protected static $tabla = 'artistas';
    protected static $columnasDB = ['id', 'nombre', 'precio_show', 'id_nivel'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio_show = $args['precio_show'] ?? '';
        $this->id_nivel = $args['id_nivel'] ?? '';
    }

    public function validarArtista(){
        if(!$this->nombre) {
            self::$alertas['error'][] = 'artists_mandatory-artist-name';
        }
        if(!$this->precio_show) {
            self::$alertas['error'][] = 'artists_mandatory-show-price';
        }
        return self::$alertas;
    }
}