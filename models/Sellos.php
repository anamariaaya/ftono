<?php

namespace Model;

class Sellos extends ActiveRecord{
    protected static $tabla = 'sellos';
    protected static $columnasDB = ['id', 'nombre', 'creado'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->creado = $args['creado'] ?? date('Y/m/d H:i:s');
    }

    // Validación para sellos al agregar un álbum
    public function validarSello() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Sello es Obligatorio';
        }
        return self::$alertas;
    }
}
