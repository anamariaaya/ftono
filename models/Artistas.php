<?php

namespace Model;

class Artistas extends ActiveRecord{
    protected static $tabla = 'artistas';
    protected static $columnasDB = ['id', 'nombre', 'precio_show'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio_show = $args['precio_show'] ?? '';
    }

    public function validarAlbum(){
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del artista es Obligatorio';
        }
        if(!$this->precio_show) {
            self::$alertas['error'][] = 'El precio del show del artista es Obligatorio';
        }
        return self::$alertas;
    }
}