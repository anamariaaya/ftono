<?php

namespace Model;

class Albums extends ActiveRecord{
    protected static $tabla = 'albums';
    protected static $columnasDB = ['id', 'titulo', 'portada', 'upc', 'publisher', 'fecha_rec', 'id_usuario'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->portada = $args['portada'] ?? '';
        $this->upc = $args['upc'] ?? '';
        $this->publisher = $args['publisher'] ?? '';
        $this->fecha_rec = $args['fecha_rec'] ?? '';
        $this->id_usuario = $args['id_usuario'] ?? '';
    }

    public function validarAlbum(){
        if(!$this->titulo) {
            self::$alertas['error'][] = 'El Título del Álbum es Obligatorio';
        }
        if(!$this->portada) {
            self::$alertas['error'][] = 'La Portada del Álbum es Obligatoria';
        }
        if(!$this->upc) {
            self::$alertas['error'][] = 'El UPC del Álbum es Obligatorio';
        }
        if(!$this->publisher) {
            self::$alertas['error'][] = 'El Publisher del Álbum es Obligatorio';
        }
        if(!$this->fecha_rec) {
            self::$alertas['error'][] = 'La Fecha de grabación del Álbum es Obligatoria';
        }
        return self::$alertas;
    }
}