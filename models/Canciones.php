<?php

namespace Model;

class Canciones extends ActiveRecord{
    protected static $tabla = 'canciones';
    protected static $columnasDB = ['id', 'titulo', 'version', 'isrc', 'url', 'sello', 'id_usuario'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->version = $args['version'] ?? '';
        $this->isrc = $args['isrc'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->sello = $args['sello'] ?? '';
        $this->id_usuario = $args['id_usuario'] ?? '';
    }

    public function validarCancion() {
        if(!$this->titulo) {
            self::$alertas['error'][] = 'music_songs_form-title_alert-required';
        }
        if(!$this->version) {
            self::$alertas['error'][] = 'music_songs_form-version_alert-required';
        }
        if(!$this->isrc) {
            self::$alertas['error'][] = 'music_songs_form-isrc_alert-required';
        }
        if(strlen($this->isrc) > 13) {
            self::$alertas['error'][] = 'music_songs_form-isrc_alert-max';
        }
        if(!$this->url) {
            self::$alertas['error'][] = 'music_songs_form-youtube_alert-required';
        }
        return self::$alertas;
    }
}
