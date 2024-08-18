<?php

namespace Model;

class NivelArtistas extends ActiveRecord{
    protected static $tabla = 'nivel_artistas';
    protected static $columnasDB = ['id', 'nombre', 'precio_show', 'nivel_en', 'nivel_es'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio_show = $args['precio_show'] ?? '';
        $this->nivel_en = $args['nivel_en'] ?? '';
        $this->nivel_es = $args['nivel_es'] ?? '';
    }
}
