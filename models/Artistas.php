<?php

namespace Model;

class Artistas extends ActiveRecord{
    protected static $tabla = 'artistas';
    protected static $columnasDB = ['id', 'nombre', 'precio_show', 'id_nivel', 'id_usuario', 'instagram', 'facebook', 'twitter', 'youtube', 'spotify', 'tiktok', 'website'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio_show = $args['precio_show'] ?? '';
        $this->id_nivel = $args['id_nivel'] ?? '';
        $this->id_usuario = $args['id_usuario'] ?? '';
        $this->instagram = $args['instagram'] ?? '';
        $this->facebook = $args['facebook'] ?? '';
        $this->twitter = $args['twitter'] ?? '';
        $this->youtube = $args['youtube'] ?? '';
        $this->spotify = $args['spotify'] ?? '';
        $this->tiktok = $args['tiktok'] ?? '';
        $this->website = $args['website'] ?? '';
    }

    public function validarArtista(){
        if(!$this->nombre) {
            self::$alertas['error'][] = 'artists_mandatory_artist-name';
        }
        if(!$this->precio_show) {
            self::$alertas['error'][] = 'artists_mandatory_show-price';
        }
        if(!$this->id_nivel) {
            self::$alertas['error'][] = 'artists_mandatory_artist-level';
        }
        return self::$alertas;
    }
}